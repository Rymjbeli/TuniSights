<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\UserRepository;
use App\Service\NavBarService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{

    #[Route('/profile', name: 'app_profile', methods: ['GET'])]
    public function profile(
        UserRepository $userRepository,
        Request $request,
        ManagerRegistry $doctrine,
        NavBarService $navBarService
    ): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $posts = $repository->findMostLikedPostsInAYear();
        $Userid = $request->get("Userid");
        $user = $this->getUser();
        if(!isset($user)){
            return new RedirectResponse($this->generateUrl('app_login'));
        }
        if(!isset($Userid)){
            $posts = $user->getPosts();
            return $this->render('Profile.html.twig',['user' => $user,'posts' => $posts]);
        }
        $user = $userRepository->find($Userid);
        if(!isset($user)){
            return new RedirectResponse($this->generateUrl('app_index'));
        }
        $posts = $user->getPosts();
        return $this->render('Profile.html.twig',['user' => $user,'posts' => $posts]);

        [
            $notifications,
            $unreadNotifications,
            $hasUnreadNotifications,
            $posts

        ] = $navBarService->navBarVariables($doctrine, $Userid);


        return $this->render('Profile.html.twig',[
            'user' => $user,
            'posts' => $posts,
            'notifications' => $notifications,
            'hasUnreadNotifications' => $hasUnreadNotifications,
            'unreadNotifications' => $unreadNotifications,

        ]);
    }
}