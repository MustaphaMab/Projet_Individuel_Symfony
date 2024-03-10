<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class NomDuController extends AbstractController
{
    #[Route('/', name: 'app_nom_du')]
    public function index(): Response
    {
        return $this->render('nom_du/index.html.twig', [
            'controller_name' => 'NomDuController',
        ]);
    }
}
