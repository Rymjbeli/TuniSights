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
    {
//        $posts = $manager->getRepository(Post::class)->findAll();
//
//        foreach ($posts as $post) {
//            $manager->remove($post);
//        }


        $postes = [
            ['title' => 'Cathédrale Saint Vincent de Paul',
                'dateTime' => "2020-12-12",
                'state' => 'Tunis',
                'city' => 'Tunis',
                'category' => 'monument',
                'place' => 'Cathédrale Saint Vincent de Paul',
                'description' => 'La cathédrale Saint Vincent de Paul est un joyau architectural au cœur de Tunis. Cette magnifique église de style néo-byzantin est un lieu de culte important pour la communauté catholique de Tunisie et attire de nombreux visiteurs pour sa beauté exceptionnelle. J\'ai eu la chance de la visiter récemment grace à mon amie (Rym) et j\'ai été émerveillée par les magnifiques vitraux, les mosaïques colorées et les fresques impressionnantes. J\'ai également pu en apprendre davantage sur l\'histoire de la cathédrale et de la communauté catholique en Tunisie. Si vous êtes à Tunis, ne manquez pas de visiter cette merveille architecturale et spirituelle. Vous pourrez peut-être assister à une messe ou simplement vous imprégner de la sérénité et de la beauté de ce lieu de culte. À la sortie de la cathédrale, vous pourrez apercevoir des vendeurs ambulants proposant des objets artisanaux et peut-être même un musicien jouant de la flûte. Et si vous avez de la chance, vous pourriez voir un petit groupe de pigeons perchés sur la statue de Saint Vincent de Paul, ou un chat errant dans l\'allée.C\'est un endroit magique qui mérite vraiment une visite !',
                'imageLink' => "cathedraleTunis2.jpg",
                'location' => "avenue habib bourguiba, tunis, tunisie"
            ],
            [
                'title' => 'Musée National du Bardo',
                'dateTime' => "2021-05-01",
                'state' => 'Tunis',
                'category' => 'museum',
                'place' => 'Musée National du Bardo',
                'location' => 'Pôle Culturel et Touristique du Bardo, 2000 Le Bardo, Tunis',
                'city' => 'Bardo',
                'description' => 'Le Musée National du Bardo est un incontournable pour tout visiteur de Tunis. Ce musée d\'art et d\'histoire présente une collection exceptionnelle d\'artefacts romains, puniques et islamiques, ainsi que des expositions temporaires fascinantes. J\'ai été impressionné par les mosaïques et les fresques bien conservées qui ont été récupérées de sites archéologiques dans toute la Tunisie. J\'ai également appris beaucoup sur l\'histoire et la culture de la Tunisie en visitant les expositions sur la vie quotidienne, l\'artisanat et la calligraphie. La cour intérieure du musée est un endroit paisible pour se reposer et réfléchir après avoir exploré les galeries. Si vous êtes intéressé par l\'histoire et l\'art, ne manquez pas de visiter ce musée incroyable.',
                'imageLink' => "museeBardo.jpg",

            ],
            [
                'title' => 'Carthage est merveilleuse',
                'dateTime' => '2021-06-05',
                'state' => 'Tunis',
                'category' => 'historical',
                'place' => 'Carthage',
                'city' => 'Carthage',
                'location' => 'Carthage, Tunisie',
                'description' => 'Carthage est un site archéologique fascinant qui témoigne de l\'histoire ancienne de la Tunisie. Vous y trouverez les ruines de l\'ancienne ville punique et romaine, ainsi que des villas romaines bien conservées avec de magnifiques mosaïques. Le site offre également des vues spectaculaires sur la mer Méditerranée et la ville de Tunis. N\'oubliez pas de visiter le Musée de Carthage, qui abrite une collection d\'artefacts de l\'époque punique et romaine, ainsi que des maquettes de la ville antique. Carthage est un lieu de visite incontournable pour tout amateur d\'histoire et d\'archéologie.',
                'imageLink' => "carthage2.jpg",
            ],
            [
                'title' => 'Déouverte du Souk de la Médina',
                'dateTime' => '202-02-20',
                'state' => 'Tunis',
                'category' => 'culture',
                'place' => 'Sok de la Médina',
                'city' => 'Tunis',
                'location' => 'la kasbah',
                'description' => "Jeviens de passer une journée incroyable à explorer le Souk de la Médina à Tunis. Ce marché traditionnel est un labyrinthe de rues étroites, de boutiques colorées et de vendeurs animés qui vendent tout, des épices et des tissus aux bijoux et aux céramiques. J'ai adoré flâner dans les ruelles et découvrir toutes les merveilles cachées dans les échoppes . Les odeurs, les couleurs et les sons du marché sont vraiment envoûtants et j'ai été fasciné par la culture et la tradition tunisiennes qui imprègnent chaque recoin du Souk. Si vous êtes à Tunis, ne manquez pas de vous perdre dans les rues animées de la Médina et de découvrir toutes les merveilles que le marché a à offrir.",
                'imageLink' => "medina2.jpg",
            ],
            ['title' => 'Randonnée dans les montagnes de Zaghouan',
                'dateTime' => '2022-03-15',
                'state' => 'Zaghouan',
                'category' => 'outdoor',
                'place' => 'Montagnes de Zaghouan',
                'city' => 'Zaghouan',
                'description' => "Aujourd'hui, j'ai fait une randonnée incroyable dans les montagnes de Zaghouan. Cette région pittoresque est connue pour ses paysages spectaculaires, ses sources d'eau chaude et ses vestiges romains. J'ai parcouru des sentiers escarpés à travers les montagnes, en admirant les vues imprenables sur la vallée en contrebas. J'ai même eu la chance de voir des troupeaux de moutons paissant paisiblement dans les champs verdoyants. À mi-chemin de ma randonnée, j'ai pris un bain dans les eaux thermales de la source de Zaghouan, qui étaient incroyablement relaxantes et revitalisantes. Cette randonnée était une expérience inoubliable et je recommande vivement à quiconque de la faire s'ils ont la chance de visiter la région.",
                'imageLink' => "zaghouan2.jpg",
                'location' => "Zaghouan, tunisie"

            ],
            [
                'title' => 'Marché central de Tunis',
                'dateTime' => '2022-02-14',
                'state' => 'Tunis',
                'category' => 'other',
                'place' => 'Marché central de Tunis',
                'city' => 'centre ville',
                'description' => "Le marché central de Tunis est un endroit incroyablement animé et coloré. J'ai adoré explorer les étals remplis d'épices, de fruits et de légumes frais, ainsi que les boucheries et les poissonneries. Les vendeurs sont très accueillants et ont plaisir à discuter avec les clients. J'ai même appris quelques mots de tunisien en discutant avec eux ! Le marché est également un excellent endroit pour acheter des souvenirs, des tissus et des articles artisanaux. Si vous voulez découvrir la vie quotidienne des Tunisiens, le marché central est un lieu à ne pas manquer.",
                'imageLink' => "marche.jpg",
                'location' => "avenue habib bourguiba, tunis, tunisie"

            ],

            [
                'title' => "L'amphithéâtre de Djem, un trésor caché de la Tunisie",
                'dateTime' => "2022-05-05",
                'state' => "mahdia",
                'category' => "historical",
                'place' => "Amphithéâtre de Djem",
                'city' => "El Djem",
                'description' => "L'amphithéâtre de Djem est un site historique spectaculaire qui mérite vraiment le détour. Construit au IIIe siècle, cet amphithéâtre pouvait accueillir jusqu'à 35 000 spectateurs pour des combats de gladiateurs et des représentations théâtrales. Aujourd'hui, il reste l'un des plus grands amphithéâtres romains du monde, et il est toujours impressionnant de se tenir sur ses gradins et d'imaginer ce que cela devait être comme de regarder un spectacle ici il y a des centaines d'années. L'architecture est magnifique et le site est très bien préservé. Si vous visitez la Tunisie, ne manquez pas l'occasion de visiter l'amphithéâtre de Djem.",
                'likesNumber' => 90,
                'imageLink' => "amphiteatreDjem.jpg",
                'location' => "djem, mahdia, tunisie"

            ],
            [
                'title' => "Coucher de soleil magique sur la plage de Kerkennah",
                'dateTime' => "2023-05-06",
                'state' => "Kerkennah",
                'category' => "beach",
                'place' => "Plage de Kerkennah",
                'city' => "Kerkennah",
                'description' => "J'ai assisté à l'un des plus beaux couchers de soleil de ma vie sur la plage de Kerkennah. Les couleurs du ciel étaient tout simplement incroyables - une palette de roses, d'oranges et de pourpres - et le soleil qui disparaissait à l'horizon était tout simplement magique. Les vagues douces et le sable doré ont créé une toile de fond parfaite pour cette scène magnifique. J'ai été émerveillé par la beauté de la nature et j'ai ressenti une paix intérieure incroyable en regardant le soleil se coucher. Si vous visitez la Tunisie, ne manquez pas de passer une soirée sur la plage de Kerkennah pour vivre cette expérience inoubliable.",
                'likesNumber' => 0,
                'imageLink' => "Kerkennah.jpg",
                'location' => "kerkennah, tunisie"

            ],
            [
                'title' => 'Le désert de Tozeur : une expérience inoubliable',
                'dateTime' => '2023-05-06',
                'state' => 'Tozeur',
                'category' => 'desert',
                'place' => 'Le désert de Tozeur',
                'city' => 'Tozeur',
                'description' => "J'ai récemment eu l'occasion de découvrir le désert de Tozeur en Tunisie, et je dois dire que c'était une expérience incroyable. Les vastes dunes de sable, les oasis luxuriantes et les montagnes impressionnantes sont à couper le souffle. J'ai fait une excursion en jeep à travers le désert, en m'arrêtant pour explorer les villages berbères et les ksour traditionnels en chemin. J'ai également eu la chance de passer une nuit dans un camp bédouin, sous un ciel étoilé incroyablement clair. C'était un moment magique que je n'oublierai jamais. Si vous êtes en Tunisie, je vous recommande vivement de découvrir la beauté du désert de Tozeur.",
                'likesNumber' => 150,
                'imageLink' => "Tozeur.jpg",
                'location' => "tozeur, tunisie"

            ],
            [
                'title' => "La beauté de La Marsa, un joyau caché de la Tunisie",
                'dateTime' => "2023-05-06",
                'state' => "Tunis",
                'category' => 'beach',
                'place' => "La Marsa",
                'city' => "Tunis",
                'description' => "La Marsa est une charmante ville balnéaire située à seulement quelques kilomètres de Tunis. Elle offre une belle plage de sable fin bordée de palmiers, une mer cristalline aux couleurs éblouissantes et des vues panoramiques à couper le souffle. Les eaux de La Marsa sont parfaites pour la baignade, la plongée et la navigation de plaisance. Les rues de la ville sont bordées de cafés et de restaurants, où vous pourrez déguster une cuisine tunisienne authentique, tout en admirant la vue sur la mer. La Marsa est également connue pour son architecture traditionnelle, avec ses belles maisons blanches et ses portes colorées. Si vous cherchez un endroit paisible et pittoresque pour vous détendre, La Marsa est l'endroit parfait.",
                'likesNumber' => 150,
                'imageLink' => "marsa2.jpg",
                'location' => "la marsa, tunis, tunisie"

            ],
            [
                'title' => "La mosquée Okba Ibn Nafi à Kairouan, un joyau de l'architecture islamique",
                'dateTime' => "2022-05-07",
                'state' => "Kairouan",
                'category' => "monument",
                'place' => "Mosquée Okba Ibn Nafi",
                'city' => "Kairouan",
                'description' => "La mosquée Okba Ibn Nafi à Kairouan est une merveille architecturale qui remonte au VIIe siècle. Elle est considérée comme l'une des plus anciennes mosquées d'Afrique du Nord et l'un des premiers monuments islamiques au monde. La mosquée est un exemple remarquable de l'architecture islamique, avec ses dômes en forme de bulbe, ses minarets élancés et ses arcades en fer à cheval. Elle est également riche en histoire et en culture, étant un lieu de pèlerinage important pour les musulmans et ayant été un centre d'enseignement islamique pendant des siècles.",
                'imageLink' => "Okba.jpg",
                'location' => "Mosquée Okba Ibn Nafi, Kairouan, Tunisie"
            ],
            [
                'title' => "Découvrez la mosquée Zitouna, joyau de Tunis",
                'dateTime' => "2023-05-06",
                'state' => "Tunis",
                'category' => "monument",
                'place' => "Mosquée Zitouna",
                'city' => "Tunis",
                'description' => "La mosquée Zitouna, également connue sous le nom de mosquée de l'olivier, est un trésor caché de Tunis. Datant du VIIIe siècle, cette mosquée est l'une des plus grandes et des plus anciennes d'Afrique du Nord. Les décorations et les mosaïques sont absolument magnifiques et représentent un mélange de styles arabe et byzantin. La mosquée est toujours en activité, et il est possible d'assister aux prières quotidiennes. Il est recommandé de visiter la mosquée avec un guide pour apprendre davantage sur son histoire et son importance culturelle.",
                'imageLink' => "zitouna.jpg",
                'location' => "Mosquée Zitouna, kasbah, Tunis"
            ],
            [
                'title' => "Découvrez les paysages à couper le souffle de Béja",
                'dateTime' => "2023-05-06",
                'state' => "Béja",
                'category' => "outdoor",
                'place' => "Béja",
                'city' => "Béja",
                'description' => "Béja est une ville qui offre des paysages à couper le souffle. Située dans le nord-ouest de la Tunisie, la ville de Béja est entourée de montagnes qui offrent des vues incroyables sur la région. Le paysage est parsemé de champs verdoyants, de vallées fertiles, de rivières sinueuses et de villages traditionnels. Les montagnes de Béja sont également un lieu idéal pour les randonneurs et les amoureux de la nature, offrant une expérience unique pour ceux qui souhaitent s'évader de la ville et découvrir des paysages à couper le souffle.",
                'imageLink' => "beja.jpg",
                'location' => "Béja, Tunisie"
            ],
            [
                'title' => "Découvrez les rues animées du centre-ville de Tunis",
                'dateTime' => "2023-05-06",
                'state' => "Tunis",
                'category' => "city",
                'place' => "Centre-ville de Tunis",
                'city' => "Tunis",
                'description' => "Le centre-ville de Tunis regorge de rues animées et colorées qui offrent une expérience unique aux visiteurs. Vous pouvez vous promener dans les rues de la médina historique et découvrir les souks traditionnels où vous pouvez trouver des épices, des tissus, des bijoux et plus encore. La rue Habib Bourguiba est également un incontournable avec ses cafés, ses boutiques et ses bâtiments coloniaux magnifiques. Si vous cherchez des endroits pour vous détendre, vous pouvez visiter la place du gouvernement, où vous pouvez vous asseoir et profiter du paysage tout en regardant les gens passer. Il y a tellement de choses à voir et à découvrir dans les rues du centre-ville de Tunis, alors assurez-vous de prendre le temps de les explorer pendant votre visite.",
                'imageLink' => "centreVille.jpg",
                'location' => "Centre-ville de Tunis, Tunisie"
            ],
            [
                'title' => "Tataouine, le désert tunisien et ses chameaux",
                'dateTime' => "2023-05-06",
                'state' => "Tataouine",
                'category' => "desert",
                'place' => "Désert de Tataouine",
                'city' => "Tataouine",
                'description' => "Tataouine est une ville située dans le sud tunisien, célèbre pour son désert et ses dunes de sable spectaculaires. La région est également connue pour ses chameaux, qui font partie intégrante de la vie dans le désert. Les chameaux sont utilisés pour le transport et pour le tourisme, offrant aux visiteurs la possibilité de découvrir le désert à dos de chameau. La vue depuis le sommet des dunes est à couper le souffle, et le coucher de soleil dans le désert est un spectacle inoubliable. Si vous cherchez une aventure dans le désert tunisien, Tataouine est un endroit à ne pas manquer.",
                'imageLink' => "desertTatawin.jpg",
                'location' => "Tataouine, Tunisie"]
        ];

        foreach ($postes as $i) {
            $post = new Post();
            $userRepository = $manager->getRepository(User::class);
            $user = $userRepository->findOneBy(['id' => rand(6, 10)]);
            /* set the rand values depending on your database*/
            $post->setOwner($user);
            $post->setTitle($i['title']);
            $post->setState($i['state']);
            $post->setCity($i['city']);
            $post->setCategory($i['category']);
            $post->setPlace($i['place']);
            $post->setLocation($i['location']);
            $post->setDescription($i['description']);
            $post->setImage($i['imageLink']);
            $post->setRating(rand(3, 5));
            $manager->persist($post);
            $manager->flush();
        }
    }
}

