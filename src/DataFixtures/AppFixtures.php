<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Categorie;
use App\Entity\Commande;
use App\Entity\LigneCommande;
use App\Entity\Livraison;
use App\Entity\PaiementCommande;
use App\Entity\Produit;
use App\Entity\Users;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i <= 30; $i++) {
            $produit = new Produit;
            $produit->setNom($faker->word)
                    ->setDescription($faker->sentence)
                    ->setPhoto($faker->imageUrl(640, 480, 'food', true))
                    ->setPrix($faker->randomFloat(2, 10, 300))
                    ->setStock($faker->numberBetween(10, 100));

            $manager->persist($produit);
        }

            $manager->flush();
        }
        
    }

