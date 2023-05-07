<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Entity\Post;
use App\Entity\User;
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
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $notifrepository = $doctrine->getRepository(Notification::class);

        $posts = $repository->findMostLikedPostsInAYear();

        $user = $this->getUser();
        if ($user !== null) {
            $notifications = $notifrepository->findNotificationsByUserId($user);
            $unreadNotifications=$notifrepository->findUnreadNotifications($user);
            if ($user->gethasUnreadNotifications()) {
                $hasUnreadNotifications = true;
                $doctrine->getManager()->flush();
            } else {
                $hasUnreadNotifications = false;
            }
        } else {
            $notifications = [];
            $hasUnreadNotifications = false;
        }

        return $this->render('index.html.twig', [
            'unreadNotifications' => $unreadNotifications,
            'posts' => $posts,
            'notifications' => $notifications,
            'hasUnreadNotifications' => $hasUnreadNotifications,
        ]);
    }

}
