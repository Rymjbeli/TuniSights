<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use App\Form\AddPostType;
use App\Service\PostService;
use App\Service\UploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/managePost/{id?0}', name: 'manage.Post')]
    public function managePost(
        Post            $post = null,
        EntityManagerInterface $entityManager,
        Request         $request,
        UploaderService $uploaderService, // inject uploaderService
        PostService     $postService // inject PostService
    ): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_index');
        }
        $new = false;
        //Var that define either the user is adding or editing a post
        $AddEdit = 'Add';

        if (!$post) {
            $new = true;
            $post = new Post();
        } else {
            $AddEdit = 'Edit';
        }

        $form = $this->createForm(AddPostType::class, $post);

        //add delete button if the user is editing an existing post, using addDeleteButton method from PostService
        $form = $postService->addDeleteButton($form, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('Image')->getData();
            $post->setOwner($this->getUser());

            // Upload and set image for the post if an image was submitted
            if ($image) {
                $directory = $this->getParameter('post_directory');
                $post->setImage($uploaderService->uploadFile($image, $directory));
            }

            $entityManager->getRepository(Post::class)->save($post, true);

            // Display success message using the addFlash and getMessage from PostService and redirect to the homepage
            $this->addFlash('success', $post->getTitle() . $postService->getMessage($new));

            return $this->redirectToRoute('app_index');
        } else {
            return $this->render('addPost.html.twig', [
                'form' => $form->createView(), 'AddEdit' => $AddEdit
            ]);

        }
    }

    #[Route('/deletePost/{id?0}', name: 'delete.Post')]
    public function deletePost(Post $post, ManagerRegistry $doctrine)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_index');
        }
        $manager = $doctrine->getManager();
        $manager->remove($post);
        $manager->flush();

        $this->addFlash('success', $post->getTitle() . ' has been deleted successfully.');
        return $this->redirectToRoute('index');
    }



}
