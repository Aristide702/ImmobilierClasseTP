<?php

namespace App\DataFixtures;

use App\Entity\Siege;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SiegeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i <= 1; $i++) { 
            $siege = new Siege();
            $siege->setCapital($faker->randomNumber($nbDigits = NULL, $strict = false))
            ->setNom($faker->lastName())
            ->setAdresse($faker->streetAddress())
            ;
            $manager->persist($siege);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
