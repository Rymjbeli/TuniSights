<?php

namespace App\Service;

use App\Entity\Notification;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class NavBarService
{
    public function navBarVariables(ManagerRegistry $doctrine, $userId):array
    {
        $userRepository=$doctrine->getRepository(User::class);
        $user =$userRepository->find($userId);
        $repository = $doctrine->getRepository(Post::class);
        $notifrepository = $doctrine->getRepository(Notification::class);

        $posts = $repository->findMostLikedPostsInAYear();

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
        return [
            $notifications,
            $unreadNotifications,
            $hasUnreadNotifications,
            $posts
        ];
    }

}