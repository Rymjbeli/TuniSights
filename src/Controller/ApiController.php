<?php

namespace App\Controller;
use App\Entity\Comment;
use App\Entity\Like;
use App\Entity\Reply;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use function Sodium\add;
date_default_timezone_set('Africa/Tunis');

#[Route('/api')]
class ApiController extends abstractController
{
    public ManagerRegistry $registry;
    public function __construct(
        ManagerRegistry        $managerRegistry,
        private NotificationController $notificationController

    )
    {
        $this->registry = $managerRegistry;
    }
    #[Route('/LoadComment',name: 'LoadCommentApi', methods: ['POST','GET'])]
    public function LoadComment(
        Request $request,
        PostRepository $postRepository,
        SerializerInterface $serializer
    ):Response
    {
        $PostId = $request->get('Post_id');
        $start = $request->get('start');


        if(!isset($PostId)||!isset($start)){
            return new Response('no parameters provided', Response::HTTP_METHOD_NOT_ALLOWED);
        }
        $post = $postRepository->find($PostId);
        if(!isset($post)){
            return new Response('Post doesnt exits', Response::HTTP_BAD_REQUEST);
        }
        $comments = $post->getComments();
        $comments = new ArrayCollection(array_reverse($comments->toArray()));
        $commentlist = $comments->slice($start*10,10);
        $commentData = array_map(function($comment ) {
            return [
                'content' => $comment->getContent(),
                'username' => $comment->getOwner()->getUsername(),
                'date' => $comment->getCreatedAt()->format('Y-m-d'),
            ];
        }, $commentlist);
        $response = new JsonResponse($commentData);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    #[Route('/AddComment',name: 'AddCommentApi', methods: ['POST'])]
    public function AddComment(Request $request,PostRepository $postRepository):Response{
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
    #[Route('/AddComment', name: 'CommentApi', methods: ['POST'])]
    public function AddPost(Request $request)
    {
        $PostId = $request->request->get('Post_Id');
        $UserId = 1;//implement get user
        $Content = $request->request->get('Content');
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
        if($user !== $post->getOwner()){
            $this->notificationController->sendNotification('comment', $post,$user,$entityManager);
        }
        return $this->json([
            'username' => $comment->getOwner()->getUsername(),
            'content' => $comment->getContent(),
            'date' => $comment->getCreatedAt()->format('Y-m-d')
        ]);
    }
    #[Route('/FetchPost', name: 'PostApi',methods: ['POST'])]
    public function FetchPost(
        Request $request,
        PostRepository $postRepository
    ): Response
    {
        $PostId = $request->request->get('Post_id');
        if(!isset($PostId)){
            return new Response('no parameters provided', Response::HTTP_METHOD_NOT_ALLOWED);
        }
        $post = $postRepository->find($PostId);
        if (!isset($post)) {
            return new Response('Post doesnt exits', Response::HTTP_BAD_REQUEST);
        }
        return $this->render('PostCard.html.twig', ['post' => $post]);
    }
    #[Route ('/CheckLike', name: 'CheckLikeApi',methods: ['GET'])]
    public function CheckLike(Request $request, PostRepository $postRepository): Response{
        $user = $this->getUser();
        $PostId = $request->get('PostId');
        if (!isset($PostId)) {
            return $this->json([
                'error' => 'insufficient data'
            ]);
        }
        $post = $postRepository->find($PostId);
        if (!isset($post)) {
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

    #[Route('/Like', name: 'LikeApi', methods: ['POST', 'GET'])]
    public function Like(
        Request $request,
        PostRepository $postRepository,
        ManagerRegistry $registry,
    )
    : Response
    {
        $entityManager = $registry->getManager();
        $userid = $this->getUser();//implement user get method
        $PostId = $request->request->get('PostId');
        if (!isset($PostId)) {
            return $this->json([
                'error' => 'insufficient data'
            ]);
        }
        $post = $postRepository->find($PostId);
        if (!isset($post)) {
            return $this->json([
                'error' => 'Post id not found'
            ]);
        }
        if(!isset($userid)){
            return $this->json([
                'error' => 'User not found'
            ]);
        }

        // Check if the current user has already liked the post
        $exists = false;
        $likes = $post->getLikes();
        foreach($likes as $like){
            if($like->getOwner() === $userid){
                // If the current user has already liked the post, remove the like entity
                // and the associated notification (if the post owner is not the current user)
                if($post->getOwner()!=$userid){
                    $notification = $like->getNotification();
                    $entityManager->remove($notification);
                    $entityManager->flush();
                }
                $entityManager->remove($like);
                $entityManager->flush();
                $exists = true;
            }
        }

        // If the current user has not yet liked the post, create a new like entity and
        // add it to the post's list of likes
        if (!$exists) {
            $like = new Like();
            $like->setOwner($userid);
            $like->setTargetPost($post);

            // If the post owner is not the current user, send a notification to the post owner
            if($userid !== $post->getOwner()){
                $this->notificationController->sendNotification('like', $post,$userid,$entityManager,$like);
            }
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