<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UtilisateurFixtures extends Fixture
{
    public const UTILISATEUR_REFERENCE = 'utilisateur_';
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $user = new Utilisateur();
            $user->setNom($faker->lastName())
                ->setPrenom($faker->firstName())
                ->setDateNaissance($faker->dateTime($max = 'now', $timezone = null))
                ->setAdresse($faker->streetAddress())
                ->setSexe($faker->title($gender = 'Homme' | 'Femme'))
                ->setTelephone($faker->phoneNumber())
                ->setMail($faker->email)
                ->setLogin($faker->userName)
                ->setPassword($faker->password)
            ;

            $manager->persist($user);
            /*             echo "Adding reference: " . self::UTILISATEUR_REFERENCE . $i . "\n";
 */
            $this->addReference(self::UTILISATEUR_REFERENCE . $i, $user);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
