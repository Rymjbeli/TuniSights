<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;


class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private StatController $statController
    )
    {
    }

    #[Route('/admin', name: 'app_adminSettings')]
    public function index(): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            return $this->render('admin_access_denied.html.twig');
        }

            $newUserCount = $this->statController->newUserStat();
        $newPostCount = $this->statController->newPostStat();
        $userCount = $this->statController->getAllUsersCount();
        $postCount = $this->statController->getAllPostsCount();
        $PostsByCategoryData = $this->statController->getPostsByCategory();
        $PostsByStateData = $this->statController->getPostsByState();
        $UsersByAgeData = $this->statController->getUsersByAge();
        return $this->render('admin/index.html.twig', [
            'newUserCount' => $newUserCount,
            'newPostCount' => $newPostCount,
            'userCount' => $userCount,
            'postCount' => $postCount,
            'chartDataByCategory' => $PostsByCategoryData,
            'chartDataByState' => $PostsByStateData,
            'chartDataByAge' => $UsersByAgeData,
        ]);
    }

    public function configureAssets(): Assets
    {
        return parent::configureAssets()
            ->addCssFile('assets/css/admin.css');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('TuniSights');

    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Posts', 'fas fa-trash', Post::class);
        yield MenuItem::linkToCrud('Comments', 'fas fa-comment', Comment::class);
    }


    public function configureActions(): Actions
    {
        $actions = parent::configureActions();
        if (!$this->isGranted('ROLE_ADMIN')) {
            $actions->disable(Action::INDEX);
            $actions->disable(Action::NEW);
            $actions->disable(Action::EDIT);
            $actions->disable(Action::DELETE);
            $actions->disable(Action::DETAIL);

            throw new AccessDeniedHttpException('Vous n\'êtes pas autorisé à accéder à cette page');
        }


        return parent::configureActions()
            ->remove(Crud::PAGE_INDEX, Action::EDIT)
            ->remove(Crud::PAGE_DETAIL, Action::EDIT)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureCrud(): Crud
    {
        return parent::configureCrud()
            ->setPaginatorPageSize(15);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        if (!$user instanceof UserInterface) {
            throw new \Exception('User must be logged in');
        }
        return parent::configureUserMenu($user)
            ->setAvatarUrl($user->getImageUrl())
            ->addMenuItems([
                MenuItem::linkToRoute('My Profile', 'fa fa-id-card', 'app_profile', ['Userid' => $user->getId()]),
            ]);
    }

}
