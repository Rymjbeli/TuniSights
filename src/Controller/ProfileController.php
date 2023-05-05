<?php

namespace App\Controller;

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
    public function index(UserRepository $userRepository, Request $request,ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $posts = $repository->findMostLikedPostsInAYear();
        $Userid = $request->get("Userid");
        if(!isset($Userid)){
            return $this->render('index.html.twig',['posts' => $posts]);
        }
        $user = $userRepository->find($Userid);
        if(!isset($user)){
            return $this->render('index.html.twig',['posts' => $posts]);
        }

        return $this->render('Profile.html.twig',['user' => $user,'posts' => $posts]);
    }
}