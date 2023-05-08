<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class StatController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin', name: 'app_adminStat')]
    public function newUserStat(): int
    {
        $startDate = new \DateTime('-2 day');
        $endDate = new \DateTime();

        $query = $this->entityManager->createQueryBuilder()
            ->select('COUNT(u.id)')
            ->from('App\Entity\User', 'u')
            ->where('u.createdAt BETWEEN :start_date AND :end_date')
            ->setParameter('start_date', $startDate)
            ->setParameter('end_date', $endDate)
            ->getQuery();

        $newUserCount = $query->getSingleScalarResult();
        return $newUserCount;
    }

    public function newPostStat(): int
    {
        $startDate = new \DateTime('-2 day');
        $endDate = new \DateTime();

        $query = $this->entityManager->createQueryBuilder()
            ->select('COUNT(p.id)')
            ->from('App\Entity\Post', 'p')
            ->where('p.createdAt BETWEEN :start_date AND :end_date')
            ->setParameter('start_date', $startDate)
            ->setParameter('end_date', $endDate)
            ->getQuery();

        $newPostCount = $query->getSingleScalarResult();
        return $newPostCount;
    }

    public function getAllUsersCount(): int
    {
        $userRepository = $this->entityManager->getRepository('App\Entity\User');
        $allUsers = $userRepository->findAll();
        $userCount = count($allUsers);

        return $userCount;
    }

    public function getAllPostsCount(): int
    {
        $postRepository = $this->entityManager->getRepository('App\Entity\Post');
        $allPosts = $postRepository->findAll();
        $postCount = count($allPosts);

        return $postCount;
    }

    public function getPostsByCategory(): array
    {
        $repository = $this->entityManager->getRepository('App\Entity\Post');
        $posts = $repository->findAll();

        // Calculate post count per category
        $categoryCounts = [];
        foreach ($posts as $post) {
            $category = $post->getCategory();
            if (isset($categoryCounts[$category])) {
                $categoryCounts[$category]++;
            } else {
                $categoryCounts[$category] = 1;
            }
        }

        // Sort categories alphabetically
        ksort($categoryCounts);

        // Prepare data for the pie chart
        $chartData = [];
        $totalPosts = count($posts);
        foreach ($categoryCounts as $category => $count) {
            $percentage = ($count / $totalPosts) * 100;
            $chartData[$category] = $percentage;
        }

        return $chartData;
    }

    public function getPostsByState(): array
    {
        $repository = $this->entityManager->getRepository('App\Entity\Post');
        $posts = $repository->findAll();

        // Calculate post count per state
        $stateCounts = [];
        foreach ($posts as $post) {
            $state = $post->getState();
            if (isset($stateCounts[$state])) {
                $stateCounts[$state]++;
            } else {
                $stateCounts[$state] = 1;
            }
        }

        // Sort states alphabetically
        ksort($stateCounts);

        // Prepare data for the doughnut chart
        $chartData = [];
        $totalPosts = count($posts);
        foreach ($stateCounts as $state => $count) {
            $percentage = ($count / $totalPosts) * 100;
            $chartData[$state] = $percentage;
        }

        return $chartData;
    }

    public function getUsersByAge(): array
    {
        $repository = $this->entityManager->getRepository('App\Entity\User');
        $users = $repository->findAll();

        // Count users by age range
        $ageCounts = [
            '13-18' => 0,
            '19-20' => 0,
            '21-30' => 0,
            '31-40' => 0,
            '41-50' => 0,
            '51-60' => 0,
            '61-70' => 0,
            '71-80' => 0,
        ];

        $today = new \DateTime();

        foreach ($users as $user) {
            $dateOfBirth = $user->getDateOfBirth();
            if ($dateOfBirth) {
                $age = $dateOfBirth->diff($today)->y;
                if ($age >= 13 && $age <= 18) {
                    $ageCounts['13-18']++;
                } elseif ($age >= 19 && $age <= 20) {
                    $ageCounts['19-20']++;
                } elseif ($age >= 21 && $age <= 30) {
                    $ageCounts['21-30']++;
                } elseif ($age >= 31 && $age <= 40) {
                    $ageCounts['31-40']++;
                } elseif ($age >= 41 && $age <= 50) {
                    $ageCounts['41-50']++;
                } elseif ($age >= 51 && $age <= 60) {
                    $ageCounts['51-60']++;
                } elseif ($age >= 61 && $age <= 70) {
                    $ageCounts['61-70']++;
                } elseif ($age >= 71 && $age <= 80) {
                    $ageCounts['71-80']++;
                }
            }
        }

        return $ageCounts;
    }

}
