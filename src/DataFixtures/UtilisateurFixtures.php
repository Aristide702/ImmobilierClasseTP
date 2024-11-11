<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UtilisateurFixtures extends Fixture
{
    public const UTILISATEUR_REFERENCE = 'utilisateur_';
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $user = new Utilisateur();
            $user->setNom($faker->lastName())
                ->setPrenoms($faker->firstName())
                ->setAdresse($faker->streetAddress())
                //->setDateNaissance($faker->dateTime($max = 'now', $timezone = null))
            ;

            $manager->persist($user);
/*             echo "Adding reference: " . self::UTILISATEUR_REFERENCE . $i . "\n";
 */            $this->addReference(self::UTILISATEUR_REFERENCE . $i, $user);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
