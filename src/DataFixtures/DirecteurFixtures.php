<?php

namespace App\DataFixtures;

use App\Entity\Directeur;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DirecteurFixtures extends Fixture
{
    public const DIRECTEUR_REFERENCE = 'directeur_';
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $directeur = new Directeur();
            $directeur->setNom($faker->lastName())
                ->setPrenom($faker->firstName())
                ->setRevenus($faker->randomFloat(2, 2000, 1000000))
            ;

            $manager->persist($directeur);
            /*             echo "Adding reference: " . self::DIRECTEUR_REFERENCE . $i . "\n";
 */
            $this->addReference(self::DIRECTEUR_REFERENCE . $i, $directeur);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
