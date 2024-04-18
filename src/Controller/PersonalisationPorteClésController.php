<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PersonalisationPorteClésController extends AbstractController
{
    #[Route('/personalisation/porte/cl/s', name: 'app_personalisation_porte_cl_s')]
    public function index(): Response
    {
        return $this->render('personalisation_porte_clés/index.html.twig', [
            'controller_name' => 'PersonalisationPorteClésController',
        ]);
    }
}
