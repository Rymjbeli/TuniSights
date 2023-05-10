<?php

namespace App\Controller;

use App\Service\NavBarService;
use App\Service\UploaderService;
use App\Entity\User;
use App\Form\EditProfileFormType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class EditProfileController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/profile/edit', name: 'app_edit_profile')]
    public function editProfile(
        Request                $request,
        EntityManagerInterface $entityManager,
        UploaderService        $uploaderService,
        ManagerRegistry        $doctrine,
        NavBarService          $navBarService  // inject navBarService


    ): Response
    {
        $user = $this->getUser();

        // Call the navBarService to get notification variables for the navbar
        [
            $notifications,
            $unreadNotifications,
            $hasUnreadNotifications,

        ] = $navBarService->navBarVariables($doctrine, $user);

        $user = $this->getUser();
        $form = $this->createForm(EditProfileFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $image = $form->get('Image')->getData();
            // Upload and set image for the post if an image was submitted
            if ($image) {
                $directory = $this->getParameter('post_directory');
                $user->setImage($uploaderService->uploadFile($image, $directory));
            }

            $entityManager->getRepository(User::class)
                ->save($user, true);
            $this->addFlash('success', 'Your profile has been updated.');
            return $this->redirectToRoute('app_profile', ['Userid' => $user->getId()]);
        }

        return $this->render('EditProfile.html.twig', [
            'form' => $form->createView(),
            'unreadNotifications' => $unreadNotifications,
            'notifications' => $notifications,
            'hasUnreadNotifications' => $hasUnreadNotifications,
        ]);
    }

}
