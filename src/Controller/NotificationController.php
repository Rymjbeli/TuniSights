<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;




class NotificationController extends AbstractController
{
    #[Route('/notification', name: 'app_notification')]
    public function index(RouterInterface $router,ManagerRegistry $doctrine): Response
    {
        // Get the notifications for the logged in user
        $user = $this->getUser();
        $repository = $doctrine->getRepository(Notification::class);
        $notifications = $repository->findOneBy($user);

        // Generate the URL for the home page
        $url = $router->generate('app_index', [
            'notifications' => $notifications,
        ]);

        // Create a redirect response to the home page with the list of notifications as a parameter
        return new RedirectResponse($url);
    }

    #[Route('/notification', name: 'notification_show')]
    public function show(Notification $notification, EntityManagerInterface $entityManager): Response
    {
        // Mark the notification as read
        $notification->setIsRead(true);
        $entityManager->flush();

        // Redirect to the profile page
        return $this->redirectToRoute('app_profile',['Userid'=> $this->getUser()->getId()]);
    }

    #[Route('/notifications/{type}/{targetPostId}/{ownerId}/', name: 'notification_send')]

    public function sendNotification(string $type, Post $targetPostId, User $ownerId,EntityManagerInterface $entityManager): Response
    {
        // Create a new notification entity
        $notification = new Notification();
        $notification->setType($type);
        $notification->setTargetPost($targetPostId);
        $notification->setOwner($ownerId);
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
