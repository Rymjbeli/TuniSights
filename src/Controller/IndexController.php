<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Entity\Post;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


#[
    Route('/index'),
]
class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(ManagerRegistry $doctrine,$notifications = []): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $notifrepository = $doctrine->getRepository(Notification::class);

        $posts = $repository->findMostLikedPostsInAYear();
        if($this->getUser()){
            $notifications= $notifrepository->findNotificationsByUserId($this->getUser());
        }

        return $this->render('index.html.twig', [
            'posts' => $posts,
            'notifications' => $notifications
        ]);
    }


    //using param convertor to automatically convert route parameter (id) to object(user)
  /*  #[Route('/user/{username}', name: 'show.user')]
    public function showUserProfil(Request $request, User $user): Response
    {
        return $this->render('profile.html.twig', [
            'user' => $user,
        ]);
    }*/



}
