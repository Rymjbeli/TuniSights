<?php

namespace App\Controller;

use App\Entity\Post;
use App\Service\NavBarService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

date_default_timezone_set('Africa/Tunis');

#[
    Route('/index'),
]
class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(
        ManagerRegistry $doctrine,
        NavBarService   $navBarService
    ): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $posts = $repository->findMostLikedPostsInAYear();
        $user = $this->getUser();
        if ($user) {
            [
                $notifications,
                $unreadNotifications,
                $hasUnreadNotifications,

            ] = $navBarService->navBarVariables($doctrine, $user);
        } else {
            $notifications = null;
            $unreadNotifications = null;
            $hasUnreadNotifications = null;
        }

        return $this->render('index.html.twig', [
            'unreadNotifications' => $unreadNotifications,
            'posts' => $posts,
            'notifications' => $notifications,
            'hasUnreadNotifications' => $hasUnreadNotifications,
        ]);
    }

}
