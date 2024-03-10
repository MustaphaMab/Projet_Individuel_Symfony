<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DeconnexionOkController extends AbstractController
{
    #[Route('/deconnexion/ok', name: 'app_deconnexion_ok')]
    public function index(): Response
    {
        return $this->render('deconnexion_ok/index.html.twig', [
            'controller_name' => 'DeconnexionOkController',
        ]);
    }
}
