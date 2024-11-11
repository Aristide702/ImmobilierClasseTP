<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ClientFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $types = [
            'Locataire',
            'Propriétaire',
        ];
        for ($i = 0; $i < 100; $i++) {
            $client = new Client();
            $client->setNom($faker->lastName())
                ->setPrenom($faker->firstName())
                ->setAdresse($faker->streetAddress())
                ->setType(array_rand($types))
                ->setPhoto('Photo')
                ->setDateNaissance($faker->dateTime($max = 'now', $timezone = null))
                ->setLogin($faker->sentence())
                ->setEmail($faker->email())
                ->setPassword(sha1("1234"))
            ;
            $manager->persist($client);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
