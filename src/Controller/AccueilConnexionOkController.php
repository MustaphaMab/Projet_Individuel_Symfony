<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilConnexionOkController extends AbstractController
{
    #[Route('/accueil/connexion/ok', name: 'app_accueil_user_connexion_ok')]
    public function index(): Response
    {
        return $this->render('accueil_user_connexion_ok/index.html.twig', [
            'controller_name' => 'AccueilConnexionOkController',
        ]);
    }
}
