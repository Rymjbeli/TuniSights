<?php

namespace App\Controller;

use App\Entity\Post;
use App\Service\NavBarService;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

#[
    IsGranted("ROLE_USER")
]
class SearchController extends AbstractController
{
    #[Route('/find', name: 'app_find')]
    public function getAll(ManagerRegistry $doctrine,  NavBarService $navBarService,// inject uploaderService
    ): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $posts = $repository->findBy([], ['rating' => 'DESC']);
        $user = $this->getUser();
        [
            $notifications,
            $unreadNotifications,
            $hasUnreadNotifications,

        ] = $navBarService->navBarVariables($doctrine, $user);
        return $this->render('Search.html.twig', [
            'postes' => $posts,
            'unreadNotifications' => $unreadNotifications,
            'notifications' => $notifications,
            'hasUnreadNotifications' => $hasUnreadNotifications,
        ]);
    }
    #[Route('/find/filter', name: 'app_find_filter')]
    public function getFiltered(
        Request $request,
        ManagerRegistry $doctrine,
        NavBarService $navBarService
    )
    {
        $user = $this->getUser();
        $state = $request->query->get('state');
        $category = $request->query->get('category');
        if ($state === 'Tous' && $category==='Tous') {
            $posts = $doctrine->getRepository(Post::class)
                ->findBy([], ['rating' => 'DESC']);
        } else if ($state === 'Tous'){
            $posts = $doctrine->getRepository(Post::class)
                ->findByCategory($category);
        } else if ($category === 'Tous'){
            $posts = $doctrine->getRepository(Post::class)
                ->findByState($state);
        } else{
            $posts = $doctrine->getRepository(Post::class)
                ->findByStateCategory($state,$category);
        }
        [
            $notifications,
            $unreadNotifications,
            $hasUnreadNotifications,

        ] = $navBarService->navBarVariables($doctrine, $user);
        return $this->render('Search.html.twig', [
            'postes' => $posts,
            'SelectedCategory' => $category,
            'SelectedState' => $state,
            'notifications' => $notifications,
            'hasUnreadNotifications' => $hasUnreadNotifications,
            'unreadNotifications' => $unreadNotifications,
        ]);
    }

    #[Route('/find/search', name: 'app_find_search')]
    public function getSearched(
        Request $request,
        ManagerRegistry $doctrine,
        NavBarService $navBarService
    )
    {
        $user = $this->getUser();
        $input = $request->query->get('search_input');

        if ($input === '' ) {
            $posts = $doctrine->getRepository(Post::class)->findBy([], ['rating' => 'DESC']);
        } else{
            $posts = $doctrine->getRepository(Post::class)->findBySearch($input);
        }
        [
            $notifications,
            $unreadNotifications,
            $hasUnreadNotifications,

        ] = $navBarService->navBarVariables($doctrine, $user);

        return $this->render('Search.html.twig', [
            'postes' => $posts,
            'TypedText' => $input,
            'notifications' => $notifications,
            'hasUnreadNotifications' => $hasUnreadNotifications,
            'unreadNotifications' => $unreadNotifications,
        ]);
    }

}
