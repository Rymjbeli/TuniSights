<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Entity\Post;
use App\Entity\User;
use App\Service\NavBarService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


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
