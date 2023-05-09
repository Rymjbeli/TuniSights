<?php

namespace App\Controller;

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
        $Userid = $request->get("Userid");
        $Userid = $userRepository->find($Userid);
        $user = $this->getUser();
        if(!isset($user)){
            return new RedirectResponse($this->generateUrl('app_login'));
        }
        if(!isset($Userid)){
            $posts = $Userid->getPosts();
            return $this->render('Profile.html.twig',['user' => $user,'posts' => $posts]);
        }
        if(!isset($Userid)){
            return new RedirectResponse($this->generateUrl('app_index'));
        }
        $posts = $Userid->getPosts();

        [
            $notifications,
            $unreadNotifications,
            $hasUnreadNotifications,


        ] = $navBarService->navBarVariables($doctrine, $user);


        return $this->render('Profile.html.twig',[
            'Userid' => $Userid,
            'posts' => $posts,
            'notifications' => $notifications,
            'hasUnreadNotifications' => $hasUnreadNotifications,
            'unreadNotifications' => $unreadNotifications,

        ]);
    }
}