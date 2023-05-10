<?php

namespace App\Service;

use App\Entity\Notification;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;


class NavBarService
{
    // This function returns an array of variables used in the navbar template
    public function navBarVariables(ManagerRegistry $doctrine, $userId):array
    {
        $userRepository=$doctrine->getRepository(User::class);
        $user =$userRepository->find($userId);
        $notifrepository = $doctrine->getRepository(Notification::class);

        // If the user exists, retrieve their notifications and unread notifications
        if ($user !== null) {
            $notifications = $notifrepository->findNotificationsByUserId($user);
            $unreadNotifications=$notifrepository->findUnreadNotifications($user);

            // If the user has unread notifications, mark them as read and flush the changes
            if ($user->gethasUnreadNotifications()) {
                $hasUnreadNotifications = true;
                $doctrine->getManager()->flush();
            } else {
                $hasUnreadNotifications = false;
            }
        } else {
            // If the user does not exist, set notifications and unread notifications
            // to empty arrays and hasUnreadNotifications to false
            $notifications = [];
            $unreadNotifications=[];
            $hasUnreadNotifications = false;

        }
        return [
            $notifications,
            $unreadNotifications,
            $hasUnreadNotifications,
        ];
    }

}