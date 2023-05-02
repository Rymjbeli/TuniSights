<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


#[
    Route('index'),
]
class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $posts = $repository->findAll();
        return $this->render('index.html.twig', ['posts' => $posts]);
    }


    //using param convertor to automatically convert route parameter (id) to object(user)
    #[Route('/index/user/{username}', name: 'show.user')]
    public function showUserProfil(Request $request, User $user): Response
    {
        return $this->render('profile.html.twig', [
            'user' => $user,
        ]);
    }

}
