<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Entity\Post;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    ): Response
    {
        $repository = $doctrine->getRepository(Post::class);

        $Userid = $request->get("Userid");
        if(!isset($Userid)){
            return $this->render('index.html.twig');
        }
        $user = $userRepository->find($Userid);
        if(!isset($user)){
            return $this->render('index.html.twig');
        }

        return $this->render('Profile.html.twig',[
            'user' => $user,
        ]);
    }
}