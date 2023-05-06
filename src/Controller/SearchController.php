<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\HttpFoundation\Request;



class SearchController extends AbstractController
{

//    #[Route('/find', name: 'app_index')]
//    public function index(): Response
//    {
//        $package = new Package(new EmptyVersionStrategy(), null);
//
//        $postes = [
//            [
//                'postId' => 1,
//                'profileUserName' => 'Mohamed',
//                'profileImage' => $package->getUrl('assets/Images/heart.png'),
//                'date' => '2020-12-12',
//                'time' => '12:00',
//                'gouvernorat' => 'Tataouine',
//                'place' => 'Le désert de Tataouine',
//                'title' => 'Aventures dans le désert de Tataouine',
//                'description' => 'Le désert de Tataouine est l\'un des endroits les plus fascinants de la Tunisie. Avec ses vastes étendues de sable doré, ses dunes majestueuses et ses paysages à couper le souffle, le désert de Tataouine est une destination incontournable pour tous les amateurs d\'aventure. J\'ai eu la chance de passer quelques jours dans le désert de Tataouine, et j\'ai vécu des moments inoubliables, entre les balades en chameau, les nuits à la belle étoile et les rencontres avec les nomades du désert. Si vous cherchez une expérience authentique et unique en Tunisie, le désert de Tataouine est l\'endroit parfait pour vous.',
//                'imageLink' => $package->getUrl('assets/Images/desertTatawin.jpg'),
//                'likesNumber' => 10,
//            ],
//            [
//                'postId' => 2,
//                'profileUserName' => 'Ines',
//                'profileImage' => $package->getUrl('assets/Images/heart.png'),
//                'date' => '2020-5-3',
//                'time' => '11:00',
//                'gouvernorat' => 'Mahdia',
//                'place' => 'Amphithéâtre de Djem',
//                'title' => 'Découvrez l\'histoire de l\'Amphithéâtre de Djem',
//                'description' => 'L\'Amphithéâtre de Djem, également appelé l\'Amphithéâtre de Thysdrus, est un site historique majeur en Tunisie. Construit au 3ème siècle après J.-C., cet amphithéâtre était l\'un des plus grands de l\'Empire romain. Aujourd\'hui, il est considéré comme l\'un des meilleurs exemples de l\'architecture romaine en Afrique du Nord. Lors de ma visite, j\'ai été fasciné par la taille et la beauté de cet édifice antique. J\'ai également appris beaucoup de choses sur l\'histoire de l\'amphithéâtre grâce aux guides locaux. Si vous êtes passionné d\'histoire et d\'architecture, je vous recommande vivement de visiter l\'Amphithéâtre de Djem lors de votre prochain voyage en Tunisie !',
//                'imageLink' => $package->getUrl('assets/Images/amphiteatreDjem.jpg'),
//                'likesNumber' => 5,
//            ],
//            ['postId' => 3,
//                'profileUserName' => "Sarra",
//                'profileImage' => $package->getUrl('assets/Images/heart.png'),
//                'date' => "2023-04-14", 'time' => "10:30",
//                'gouvernorat' => 'Nabeul',
//                'place' => 'Plage de Nabeul',
//                'title' => 'Découverte des traditions des pêcheurs de Nabeul',
//                'description' => "La plage de Nabeul est l'un des joyaux cachés de la Tunisie. Cette magnifique plage de sable blanc offre une vue imprenable sur les eaux cristallines de la Méditerranée. Lors de mon dernier voyage à Nabeul, j'ai décidé de partir à la découverte des traditions des pêcheurs locaux. J'ai eu la chance de rencontrer un pêcheur qui m'a expliqué les différentes techniques de pêche qu'il utilise pour capturer les poissons de la région. Nous avons discuté de la vie des pêcheurs de Nabeul et de l'importance de la mer pour la communauté locale. À la fin de notre conversation, j'ai pu voir le pêcheur partir dans son petit bateau en direction de la mer, pour une journée de travail.",
//                'imageLink' => $package->getUrl('assets/Images/plageNabeul.jpg'),
//                'likesNumber' => 15,
//            ],
//            [
//                'postId' => 4,
//                'profileUserName' => 'Rim',
//                'profileImage' => $package->getUrl('assets/Images/heart.png'),
//                'date' => '2022-02-15',
//                'time' => '16:30',
//                'gouvernorat' => 'Tunis',
//                'place' => 'Cathédrale Saint Vincent de Paul',
//                'title' => 'Une visite inoubliable à la cathédrale de Tunis',
//                'description' => "La cathédrale Saint Vincent de Paul est un joyau architectural au cœur de Tunis. Cette magnifique église de style néo-byzantin est un lieu de culte important pour la communauté catholique de Tunisie et attire de nombreux visiteurs pour sa beauté exceptionnelle. J'ai eu la chance de la visiter récemment et j'ai été émerveillée par les magnifiques vitraux, les mosaïques colorées et les fresques impressionnantes. J'ai également pu en apprendre davantage sur l'histoire de la cathédrale et de la communauté catholique en Tunisie. Si vous êtes à Tunis, ne manquez pas de visiter cette merveille architecturale et spirituelle. Vous pourrez peut-être assister à une messe ou simplement vous imprégner de la sérénité et de la beauté de ce lieu de culte. À la sortie de la cathédrale, vous pourrez apercevoir des vendeurs ambulants proposant des objets artisanaux et peut-être même un musicien jouant de la flûte. Et si vous avez de la chance, vous pourriez voir un petit groupe de pigeons perchés sur la statue de Saint Vincent de Paul, ou un chat errant dans l'allée.C'est un endroit magique qui mérite vraiment une visite !",
//                'imageLink' => $package->getUrl('assets/Images/cathedraleTunis.jpg'),
//                'likesNumber' => 20,
//            ]
//
//
//        ];
//
//        return $this->render('Search.html.twig', [
//            'postes' => $postes,
//        ]);
//    }

    #[Route('/find', name: 'app_find')]
    public function getAll(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Post::class);
        $posts = $repository->findAll();
        return $this->render('Search.html.twig', ['postes' => $posts]);
    }
    #[Route('/find/filter', name: 'app_find_filter')]
    public function getFiltered(Request $request, ManagerRegistry $doctrine)
    {
        $state = $request->query->get('state');
        $category = $request->query->get('category');
        $repository = $doctrine->getRepository(Post::class);

        if ($state === 'Tous' && $category==='Tous') {
            $posts = $doctrine->getRepository(Post::class)
                ->findAll();
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

        return $this->render('Search.html.twig', ['postes' => $posts, 'SelectedCategory' => $category, 'SelectedState' => $state]);
    }

    #[Route('/find/search', name: 'app_find_search')]
    public function getSearched(Request $request, ManagerRegistry $doctrine)
    {
        $input = $request->query->get('search_input');
        $repository = $doctrine->getRepository(Post::class);

        if ($input === '' ) {
            $posts = $doctrine->getRepository(Post::class)->findAll();
        } else{
            $posts = $doctrine->getRepository(Post::class)->findBySearch($input);
        }

        return $this->render('Search.html.twig', ['postes' => $posts, 'TypedText' => $input]);
    }


}
