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

// CATEGORIE 

        for ($i = 0; $i < 10; $i++) {
            $categorie = new Categorie();
            $categorie->setNom($faker->word)
                      ->setDescription($faker->paragraph); // Génère un paragraphe pour la description
    
            $manager->persist($categorie);
        }

// PRODUIT
$produits = []; 
        for ($i = 0; $i <= 30; $i++) {
            $produit = new Produit;
            $produit->setNom($faker->word)
                    ->setDescription($faker->sentence)
                    ->setPhoto($faker->imageUrl(640, 480, 'food', true))
                    ->setPrix($faker->randomFloat(2, 10, 300))
                    ->setStock($faker->numberBetween(10, 100));

            $manager->persist($produit);
            $produits[] = $produit;
        
      
        }

//USERS

        for ($i = 0; $i < 30; $i++) {
            $user = new Users();
            $user->setNom($faker->lastName)
                 ->setPrenom($faker->firstName)
                 ->setRole('ROLE_USER') // Ajuste selon les besoins
                 ->setMdP(password_hash($faker->password, PASSWORD_DEFAULT)) // Hash du mot de passe
                 ->setDateNaissance($faker->dateTimeBetween('-100 years', '-18 years')) // Assure-toi que les utilisateurs sont majeurs
                 ->setTelephone($faker->phoneNumber) // Génère un numéro de téléphone
                 ->setAdresse($faker->address); // Génère une adresse

            $manager->persist($user);
        }

// COMMANDE
$commandes = [];
for ($i = 0; $i < 20; $i++) {
    $commande = new Commande();
    $commande->setValidation($faker->boolean ? 'Validée' : 'Non validée')
         ->setStatut($faker->randomElement(['En attente', 'Expédiée', 'Livré']))
         ->setDate($faker->dateTimeThisYear()->format('Y-m-d H:i:s'))
         ->setSuivi($faker->regexify('[A-Z0-9]{10}'))
         ->setMontant($faker->randomFloat(2, 20, 1000));
          
    $manager->persist($commande);
  $commandes[] = $commande;
}

// LIGNES DE COMMANDE

foreach ($commandes as $commande) {
    for ($j = 0; $j < mt_rand(1, 5); $j++) {
        $ligneCommande = new LigneCommande();
        $ligneCommande->setCommande($commande)
                      ->setProduit($faker->randomElement($produits))
                      ->setPrixTotal(mt_rand(1, 3) * 100); // Supposons que setPrixTotal attend un montant
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