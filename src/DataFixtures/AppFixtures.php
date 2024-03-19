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
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // CATEGORIE 

        $categories = [];
        for ($i = 0; $i < 10; $i++) {
            $categorie = new Categorie();
            $categorie->setNom($faker->word)
                      ->setDescription($faker->paragraph);

            $manager->persist($categorie);
            $categories[] = $categorie; // Stocke les catégories pour une utilisation ultérieure
        }


        // PRODUIT
        $produits = []; // Optionnel, seulement si tu as besoin de garder une référence des produits
        for ($i = 0; $i <= 30; $i++) {
            $produit = new Produit();
            $produit->setNom($faker->word)
                    ->setDescription($faker->sentence)
                    ->setPhoto($faker->imageUrl(640, 480, 'food', true))
                    ->setPrix($faker->randomFloat(2, 10, 300))
                    ->setStock($faker->numberBetween(10, 100))
                    ->setCategorie($faker->randomElement($categories)); // Attribue une catégorie aléatoirement
        
            $manager->persist($produit);

        //USERS

        for ($i = 0; $i < 30; $i++) {
            $user = new User();

            $roles = ['ROLE_USER', 'ROLE_ADMIN', 'ROLE_SUPER_ADMIN'];
            $randomRole = $faker->randomElement($roles); // Sélectionne un rôle aléatoirement

            $user->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                 // Affecte le rôle aléatoirement
                ->setMdP(password_hash($faker->password, PASSWORD_DEFAULT)) // Hash du mot de passe
                ->setDateNaissance($faker->dateTimeBetween('-100 years', '-18 years')) // Assure-toi que les utilisateurs sont majeurs
                ->setTelephone($faker->phoneNumber) // Génère un numéro de téléphone
                ->setAdresse($faker->address) // Génère une adresse
                ->setEmail($faker->email) // Génère une adresse e-mail
                ->setCodePostale($faker->postcode) // Génère un code postal
                ->setPays($faker->country); // Génère un nom de pays

            $manager->persist($user);
        }

        // COMMANDE
        $commandes = [];
        for ($i = 0; $i < 20; $i++) {
            $commande = new Commande();
            $commande->setDate($faker->dateTimeThisYear()->format('Y-m-d H:i:s'))
                ->setCommentaire($faker->sentence); // Ajoute un commentaire aléatoire
            $manager->persist($commande);
            $commandes[] = $commande;
        }

        // LIGNES DE COMMANDE

        foreach ($commandes as $commande) {
            for ($j = 0; $j < mt_rand(1, 5); $j++) {
                $ligneCommande = new LigneCommande();
                $ligneCommande->setCommande($commande)
                              ->setProduit($faker->randomElement($produits))
                              ->setPrixTotal(mt_rand(1, 3) * 100) // Supposons que setPrixTotal attend un montant
                              ->setCommentaire($faker->realText(200)); // Génère un commentaire aléatoire
               

                              $manager->persist($ligneCommande);
            }
        }


        // PAIEMENT DE COMMANDE

        foreach ($commandes as $commande) {
            $paiementCommande = new PaiementCommande();
            $paiementCommande->setCommande($commande)
                ->setMontant($faker->randomFloat(2, 20, 1000))
                ->setMethode($faker->randomElement(['Carte de crédit', 'PayPal', 'Virement bancaire']))
                ->setStatut($faker->randomElement(['Payé', 'En attente', 'Annulé']))
                ->setDate($faker->date($format = 'Y-m-d', $max = 'now'));
            $manager->persist($paiementCommande);
        }


        // LIVRAISON

        for ($i = 0; $i < 20; $i++) {
            $livraison = new Livraison();
            $livraison->setNumeroSuivi($faker->regexify('[A-Z0-9]{10}'))
                ->setFraisLivraison($faker->randomFloat(2, 5, 50))
                ->setTransporteur($faker->randomElement(['DHL', 'FedEx', 'UPS', 'La Poste']))
                ->setPodsEnGramme($faker->numberBetween(100, 5000));

            $manager->persist($livraison);
        }

        $manager->flush();
    }

    }
}