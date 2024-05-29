<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PaiementCommandeUserController extends AbstractController
{
    #[Route('/paiement/commande/user', name: 'app_paiement_commande_user')]
    public function index(): Response
    {
        return $this->render('paiement_commande_user/index.html.twig', [
            'controller_name' => 'PaiementCommandeUserController',
        ]);
    }
}
