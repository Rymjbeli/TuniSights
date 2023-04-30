<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;
use App\Entity\Post;
use App\Entity\User;

class PostFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {   // Array of examples of cities in Tunisia
        $city = [
            'Gammarth',
            'Sidi Bou Said',
            'La Marsa',
            'Carthage',
            'Hammamet',
            'Djerba',
            'Matmata',
            'Kelibia',
            'Kerkennah',
            'El Haouaria',
            'Tabarka',
            'Zarzis',
            'Thuburbo Majus',
            'Dougga',
            'El Jem',
            'Moknine',
            'Kebili',
            'Ghar El Melh',
            'Menzel Temime',
            'Takrouna',
            'Oudhref',
            'Chenini',
            'Ghomrassen',
            'Toujane',
            'Nefta',
            'Sbeitla',
            'Sidi Bou Ali',
            'Sidi Bou Helal',
            'Tamerza',
            'Teboursouk',
            'Zriba',
            'Zarzouna',
        ];

        //24 State of Tunisia
        $states = [
            'Ariana',
            'Beja',
            'Ben Arous',
            'Bizerte',
            'Gabes',
            'Gafsa',
            'Jendouba',
            'Kairouan',
            'Kasserine',
            'Kebili',
            'Kef',
            'Mahdia',
            'Manouba',
            'Medenine',
            'Monastir',
            'Nabeul',
            'Sfax',
            'Sidi Bouzid',
            'Siliana',
            'Sousse',
            'Tataouine',
            'Tozeur',
            'Tunis',
            'Zaghouan',
        ];

        //Categories of Places, it will be a fixed  list in the addPost form
        $categories = ['cafe', 'restau', 'parc', 'museum', 'monument', 'beach', 'natural view', 'other'];

        // Array of examples of places in Tunisia( name of the category => beach -> Hergla Beach
        $places = [
            'Amphitheater of El Jem',
            'Bardo Museum',
            'Carthage National Museum',
            'El Ghriba Synagogue',
            'Ichkeul National Park',
            'Kelibia Fortress',
            'Mahdia Beach',
            'Matmata Underground Houses',
            'Monastir Marina',
            'Oasis of Tozeur',
            'Roman Colosseum of Thysdrus',
            'Sidi Bou Said Museum',
            'Sousse Archaeological Museum',
            'Tataouine Ksour',
            'Tunis Medina',
            'Zitouna Mosque',
            'El Djem Fortress',
            'Chott el Djerid',
            'Chebika Oasis',
            'Hergla Beach',
            'Café de Paris',
            'Café Expresso',
            'Café Bardo',
        ];

        // Find all image files in the 'public/images' directory and its subdirectories
        $finder = new Finder();
        $finder->files()->in('public/assets/Images')->name('*.jpg');

        // Build an array of file paths
        $imagePaths = [];
        foreach ($finder as $fileInfo) {
            $imagePaths[] = $fileInfo->getRealPath();
        }

        // Create 20 Posts
        for ($i = 0; $i < 20; $i++) {
            $userRepository = $manager->getRepository(User::class);
            $user = $userRepository->findOneBy(['id' => ($i % 10) + 6]);

            $post = new Post();

            $post->setTitle('Post ' . ($i + 1));
            $post->setDescription('Description of post ' . ($i + 1).'Lorem ipsum 
            dolor sit amet, consectetur adipiscing elit. Proin vitae leo quis nibh pulvinar 
            bibendum. Etiam in justo ut nisi efficitur tincidunt. Integer euismod lobortis neque.');

            $post->setCategory($categories[array_rand($categories)]);
            $post->setPlace($places[array_rand($places)]);
            $post->setState($states[array_rand($states)]);
            $post->setCity($city[array_rand($city)]);
            $post->setLocation('Location ' . ($i + 1));
            $post->setOwner($user);
            $post->setRating(intval(rand(1, 5)));
            $post->setImage($imagePaths[array_rand($imagePaths)]);
            $manager->persist($post);
        }

        $manager->flush();
    }
}
