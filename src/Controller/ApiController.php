<?php

namespace App\Controller;
use App\Entity\Comment;
use App\Entity\Like;
use App\Entity\Post;
use App\Entity\Reply;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use function Sodium\add;

#[Route('/api')]
class ApiController extends abstractController
{
    public ManagerRegistry $registry;
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->registry = $managerRegistry;
    }
    #[Route('/AddComment',name: 'CommentApi', methods: ['POST'])]
    public function AddPost(Request $request,PostRepository $postRepository):Response{
        $PostId = $request->get('Post_id');
        $user = $this->getUser();
        $Content = $request->get('Content');
        if(!isset($user)){
            return new Response('you have to login to use this method', Response::HTTP_METHOD_NOT_ALLOWED);
        }
        if(!isset($PostId) || !isset($Content)){
            return new Response('no parameters provided', Response::HTTP_METHOD_NOT_ALLOWED);
        }
        $post = $postRepository->find($PostId);
        if(!isset($post)){
            return new Response('Post doesnt exits', Response::HTTP_BAD_REQUEST);
        }
        //this will be used if reply system is implemented
        /*
        $Target = $request->request->get('Target');
        if(isset($Target)){
            $commentrepo = $this->registry->getRepository(Comment::class);
            $comment = $commentrepo->find($Target);
            if(!isset($comment)){
                return new Response('Target doesnt exits', Response::HTTP_BAD_REQUEST);
            }
            $reply = new Reply();
            $reply->setOwner($User);
            $reply->setTarget($comment);
            $reply->setContent($Content);
            $entityManager = $this->registry->getManager();
            $entityManager->persist($reply);
            $entityManager->flush();
            return new Response('Reply added', Response::HTTP_OK);
        }*/
        $comment = new Comment();
        $comment->setOwner($user);
        $comment->setTargetPost($post);
        $comment->setContent($Content);
        $entityManager = $this->registry->getManager();
        $entityManager->persist($comment);
        $entityManager->flush();
        return new Response('Comment added', Response::HTTP_OK);
    }
    #[Route('/FetchPost', name: 'PostApi',methods: ['POST'])]
    public function FetchPost(Request $request, PostRepository $postRepository): Response{
        $PostId = $request->request->get('Post_id');
        if(!isset($PostId)){
            return new Response('no parameters provided', Response::HTTP_METHOD_NOT_ALLOWED);
        }
        $post = $postRepository->find($PostId);
        if(!isset($post)){
            return new Response('Post doesnt exits', Response::HTTP_BAD_REQUEST);
        }
        return $this->render('PostCard.html.twig',['post' => $post]);
    }
    #[Route ('/CheckLike', name: 'CheckLikeApi',methods: ['GET'])]
    public function CheckLike(Request $request, PostRepository $postRepository): Response{
        $user = $this->getUser();
        $PostId = $request->get('PostId');
        if(!isset($PostId)){
            return $this->json([
                'error' => 'insufficient data'
            ]);
        }
        $post = $postRepository->find($PostId);
        if(!isset($post)){
            return $this->json([
                'error' => 'Post id not found'
            ]);
        }
        $likes = $post->getLikes();
        foreach($likes as $like){
            if($like->getOwner() === $user){
                return $this->json([
                    'Liked' => true
                ]);
            }
        }
        return $this->json([
            'Liked' => false
        ]);
    }
    #[Route('/Like', name: 'LikeApi',methods: ['POST','GET'])]
    public function Like(Request $request, PostRepository $postRepository, UserRepository $userRepository, ManagerRegistry $registry): Response
    {
        $entityManager = $registry->getManager();
        $userid = $this->getUser();//implement user get method
        $PostId = $request->request->get('PostId');
        if(!isset($PostId)){
            return $this->json([
                'error' => 'insufficient data'
            ]);
        }
        $post = $postRepository->find($PostId);
        if(!isset($post)){
            return $this->json([
                'error' => 'Post id not found'
            ]);
        }

        if(!isset($userid)){
            return $this->json([
                'error' => 'User not found'
            ]);
        }
        $exists = false;
        $likes = $post->getLikes();
        foreach($likes as $like){
            if($like->getOwner() == $userid){
                $entityManager->remove($like);
                $entityManager->flush();
                $exists = true;
            }
        }
        if(!$exists){
        $like = new Like();
        $like->setOwner($userid);
        $like->setTargetPost($post);
        $entityManager->persist($like);
        $entityManager->flush();
        $likes->add($like);
        }
        return $this->json([
            'message' => 'success',
            'LikeCount' => count($likes)
        ]);
    }
}