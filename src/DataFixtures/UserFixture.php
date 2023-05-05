<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;
use function Webmozart\Assert\Tests\StaticAnalysis\allNullOrEmail;

class UserFixture extends Fixture implements FixtureGroupInterface
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {}
    public function load(ObjectManager $manager): void
    {
//        // Create Ines admin user
//        $ines = new User();
//        $ines->setEmail('ines.samet@insat.ucar.tn');
//        $ines->setPassword($this->hasher->hashPassword($ines, 'ines123'));
//        $ines->setRoles(['ROLE_ADMIN']);
//        $ines->setUsername('Ines');
//        $ines->setDateOfBirth(new \DateTimeImmutable('2003-02-01'));
//        $ines->setGender('F');
//        $manager->persist($ines);
//
//        // Create Rym admin user
//        $rym = new User();
//        $rym->setEmail('rim.jbeli@insat.ucar.tn');
//        $rym->setPassword($this->hasher->hashPassword($rym, 'rym123'));
//        $rym->setRoles(['ROLE_ADMIN']);
//        $rym->setUsername('rym');
//        $rym->setDateOfBirth(new \DateTimeImmutable('2002-06-22'));
//        $rym->setGender('F');
//        $manager->persist($rym);
//
//        // Create Sara admin user
//        $sara = new User();
//        $sara->setEmail('sarra.drine@insat.ucar.tn');
//        $sara->setPassword($this->hasher->hashPassword($sara, 'sara123'));
//        $sara->setRoles(['ROLE_ADMIN']);
//        $sara->setUsername('sara');
//        $sara->setDateOfBirth(new \DateTimeImmutable('2002-08-20'));
//        $sara->setGender('F');
//        $manager->persist($sara);
//
//        // Create Aziz admin user
//        $aziz = new User();
//        $aziz->setEmail('mohamedaziz.benghorbel@insat.ucar.tn');
//        $aziz->setPassword($this->hasher->hashPassword($aziz, 'aziz123'));
//        $aziz->setRoles(['ROLE_ADMIN']);
//        $aziz->setUsername('aziz');
//        $aziz->setDateOfBirth(new \DateTimeImmutable('2002-03-25'));
//        $aziz->setGender('M');
//        $manager->persist($aziz);
//
//
//        // Create Mohamed admin user
//        $mohamed = new User();
//        $mohamed->setEmail('mohamed.zouaghi@insat.ucar.tn');
//        $mohamed->setPassword($this->hasher->hashPassword($mohamed, 'mohamed123'));
//        $mohamed->setRoles(['ROLE_ADMIN']);
//        $mohamed->setDateOfBirth(new \DateTimeImmutable('2002-04-16'));
//        $mohamed->setGender('M');
//        $mohamed->setUsername('mohamed');
//        $manager->persist($mohamed);
//
//        //Create 5 other users with Faker
//        $faker = Factory::create('fr_FR');
//            for ($i = 1; $i <= 5; $i++) {
//                $user = new User();
//                $user->setUsername($faker->userName);
//                $user->setEmail($faker->email);
//                $user->setPassword($this->hasher->hashPassword($user, 'password'));
//                $user->setDateOfBirth($faker->dateTimeBetween('-50 years', '-18 years'));
//                $user->setGender($faker->randomElement(['M', 'F']));
//                $user->setBio('Lorem ipsum dolor sit amet, consectetur adipiscing elit.
//                Proin vitae leo quis nibh pulvinar bibendum. Etiam in justo ut nisi efficitur
//                tincidunt. Integer euismod lobortis neque.');
//
//                $manager->persist($user);
//            }
//
//        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['user'];
    }
}