<?php

namespace App\DataFixtures;

use App\Entity\Directeur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class DirecteurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i <= 1; $i++) {
            $directeur = new Directeur();
            $directeur->setNom($faker->lastName())
                ->setPrenom($faker->firstName())
                ->setRevenus($faker->randomNumber($nbDigits = NULL, $strict = false))
            ;
            $manager->persist($directeur);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
