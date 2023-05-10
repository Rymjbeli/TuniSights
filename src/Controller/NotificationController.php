<?php

namespace App\Controller;

use App\Entity\Like;
use App\Entity\Notification;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class NotificationController extends AbstractController
{

    #[Route('/notification/{id}', name: 'notification_show')]
    public function show(
        EntityManagerInterface $entityManager,
        Notification $notification)
    : Response
    {
        // Mark the notification as read
        $notification->setIsRead(true);
        $entityManager->flush();
        $user = $this->getUser();
        // Redirect to the profile page
        return $this->json(['message' => 'sucess']);
    }

    #[Route('/notifications/{type}/{targetPostId}/{ownerId}/', name: 'notification_send')]
    public function sendNotification(
        string $type,
        Post $targetPostId,
        User $ownerId,
        EntityManagerInterface $entityManager,
        Like $like = null,
    ): Response
    {
        // Create a new notification entity
        $notification = new Notification();
        $notification->setType($type);
        $notification->setTargetPost($targetPostId);
        $notification->setOwner($ownerId);

        // If the notification is for a like, set the corresponding like
        // object and the notification on the like object
        if($type == 'like'){
            $notification->setForLike($like);
            $like->setNotification($notification);
        }

        // Set the notification as unread
        $notification->setIsRead(false);


        // Save the notification
        $entityManager->getRepository(Notification::class)->save($notification, true);

        return $this->redirectToRoute('app_index');

    }

    // Add the route for removing the notification
    #[Route('/remove-notification', name: 'remove_notification')]
    public function removeNotification(ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        $user->setHasUnreadNotifications(false);
        $doctrine->getManager()->flush();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }

}
