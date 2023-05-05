<?php

namespace App\Controller;
use App\Entity\Like;
use App\Entity\Post;
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

    }
    #[Route('/AddComment',name: 'CommentApi', methods: ['POST'])]
    public function AddPost(Request $request){
        $PostId = $request->request->get('Post_Id');
        $UserId = 1;//implement get user
        $Content = $request->request->get('Content');
        $Target = $request->request->get('Target');

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
        $userid = 1;//implement user get method
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
            if($like->getOwner()->getId() == $userid){
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