<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommandeRepository;

class MesCommandesController extends AbstractController
{
    #[Route('/mes/commandes', name: 'app_mes_commandes')]
    public function index(CommandeRepository $commandeRepository): Response
    {
        // Récupérer toutes les commandes depuis le dépôt
        $commandes = $commandeRepository->findAll();

        // Log pour vérifier les données récupérées
        foreach ($commandes as $commande) {
            error_log('Commande ID: ' . $commande->getId());
            foreach ($commande->getLigneCommandes() as $ligneCommande) {
                error_log('Produit: ' . $ligneCommande->getProduit()->getNom());
            }
        }

        // Passer les commandes au template
        return $this->render('Users/mes_commandes/index.html.twig', [
            'commandes' => $commandes,
        ]);
    }
}
