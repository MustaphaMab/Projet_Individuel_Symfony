<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MesCommandesController extends AbstractController
{
    #[Route('/mes/commandes', name: 'app_mes_commandes')]
    public function index(): Response
    {
        return $this->render('Users/mes_commandes/index.html.twig', [
            'controller_name' => 'MesCommandesController',
        ]);
    }
}
