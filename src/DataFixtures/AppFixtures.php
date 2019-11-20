<?php

namespace App\DataFixtures;

use App\Entity\Cities;
use App\Entity\Participants;
use App\Entity\Places;
use App\Entity\Sites;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{


    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create('fr_FR');

        /*
         *
         // création d'un site pour alimenter les 100 participants ci-dessous

        $site = new Sites();
        $site->setId(1);
        $site->setNameSite('Quimper');


        // création de 100 participants

        $site = $manager->getRepository('App:Sites')->find(1);

            for ($i = 0; $i < 100; $i++) {
                $user = new Participants();

                $user->setActive(true);
                $user->setAdministrator(false);
                $user->setNickname($faker->userName);
                $password = $this->encoder->encodePassword($user, 'pass');
                $user->setPassword($password);
                $user->setFirstname($faker->firstName);
                $user->setLastname($faker->lastName);
                $user->setMail($faker->email);
                $user->setUrlPhoto($faker->imageUrl());
                $user->setPhone($faker->phoneNumber);
                $user->setSite($site);

                $manager->persist($user);
            }

        */

        /*
            // création de 10 villes pour alimenter Cities et Places

        $cities = [
            'Quimper',
            'Le Mans',
            'La Roche sur Yon',
            'Niort',
            'Rennes',
            'Nantes',
            'Brest',
            'Benodet',
            'Plomelin',
            'Plouigneau',
         ];

        foreach ($cities as $key =>$name) {
            $city = new Cities();
            $city->setNameCity($name);
            $city->setZip($faker->postcode);
            $manager->persist($city);
            $this->addReference('city_' . $key, $city);

        }
            // création de 50 places
            for ($i = 0; $i < 50; $i++) {
                $place = new Places();

                $place->setCity($this->getReference('city_'.rand(0, 9)));
                $place->setNamePlace($faker->streetName);
                $place->setStreet($faker->streetName);
                $place->setLatitude($faker->latitude);
                $place->setLongitude($faker->longitude);
                $manager->persist($place);
            }
        */

        /*
            $manager->flush();
        */

        }



}
