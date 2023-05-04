<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class ProfileController extends AbstractController
{
    #[Route('/Profile', name: 'app_profile', methods: ['GET'])]
    public function index(UserRepository $userRepository, Request $request): Response
    {
        $Userid = $request->get("Userid");
        if(!isset($Userid)){
            return $this->render('index.html.twig');
        }
        $user = $userRepository->find($Userid);
        if(!isset($user)){
            return $this->render('index.html.twig');
        }
        return $this->render('Profile.html.twig',['user' => $user]);
    }
}