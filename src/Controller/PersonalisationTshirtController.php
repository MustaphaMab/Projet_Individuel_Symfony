<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PersonalisationTshirtController extends AbstractController
{
    #[Route('/personalisation/tshirt', name: 'app_personalisation_tshirt')]
    public function index(): Response
    {
        return $this->render('personalisation_tshirt/index.html.twig', [
            'controller_name' => 'PersonalisationTshirtController',
        ]);
    }
}