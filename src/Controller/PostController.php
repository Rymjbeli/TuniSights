<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\AddPostType;
use App\Service\NavBarService;
use App\Service\ExtraService;
use App\Service\UploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[
        Route('/managePost/{id?0}', name: 'manage.Post'),
        IsGranted("ROLE_USER")
    ]
    public function managePost(
        Post                   $post = null,
        EntityManagerInterface $entityManager,
        Request                $request,
        ManagerRegistry        $doctrine,
        UploaderService        $uploaderService, // inject uploaderService
        ExtraService           $extraService, // inject ExtraService
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

        //Vars that define either the user is adding or editing a post
        $new = false;
        $AddEdit = 'Add';


        // Check if $post exists, if not create new Post object
        if (!$post) {
            $new = true;
            $post = new Post();
        } else {
            // Check if the current user owns the post being edited
            if ($post->getOwner() != $user) {
                // Display error message using the getMessage method from ExtraService and redirect to the homepage
                $this->addFlash('danger', $extraService->getMessage(3));
                return $this->redirectToRoute('app_index', [
                    'Userid' => $user->getId(),
                    'unreadNotifications' => $unreadNotifications,
                    'notifications' => $notifications,
                    'hasUnreadNotifications' => $hasUnreadNotifications,
                ]);

            }
            $AddEdit = 'Edit';
        }

        $form = $this->createForm(AddPostType::class, $post);

        //add delete button if the user is editing an existing post,
        // using addDeleteButton method from ExtraService
        $form = $extraService->addDeleteButton($form, $post);

        //if the user is editing, the image field is removed
        if (!$new) {
            $form->remove('Image');
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setOwner($this->getUser());
            if ($new) {
                $image = $form->get('Image')->getData();
                // Upload and set image for the post if an image was submitted
                if ($image) {
                    $directory = $this->getParameter('post_directory');
                    $post->setImage($uploaderService->uploadFile($image, $directory));
                }
            }

            $entityManager->getRepository(Post::class)->save($post, true);

            // Display success message using the addFlash and getMessage from ExtraService and redirect to the homepage
            if ($new) {
                $this->addFlash('success', $extraService->getMessage(1));
            } else {
                $this->addFlash('success', $extraService->getMessage(2));
            }

            return $this->redirectToRoute('app_profile', [
                'Userid' => $user->getId(),
                'unreadNotifications' => $unreadNotifications,
                'notifications' => $notifications,
                'hasUnreadNotifications' => $hasUnreadNotifications,
            ]);
        } else {
            return $this->render('addPost.html.twig', [
                'unreadNotifications' => $unreadNotifications,
                'notifications' => $notifications,
                'hasUnreadNotifications' => $hasUnreadNotifications,
                'form' => $form->createView(),
                'AddEdit' => $AddEdit,

            ]);

        }
    }

    #[
        Route('/deletePost/{id?0}', name: 'delete.Post'),
        IsGranted("ROLE_USER")
    ]
    public function deletePost(
        Post            $post,
        ManagerRegistry $doctrine,
        ExtraService    $extraService, // inject ExtraService
    )
    {
        $user = $this->getUser();
        $manager = $doctrine->getManager();
        $manager->remove($post);
        $manager->flush();

        $this->addFlash('success', $extraService->getMessage(4));
        return $this->redirectToRoute('app_profile', ['Userid' => $user->getId()]);
    }


}
