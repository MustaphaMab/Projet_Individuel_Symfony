<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PersonalisationMarquesPagesController extends AbstractController
{
    #[Route('/personalisation/marques/pages', name: 'app_personalisation_marques_pages')]
    public function index(): Response
    {
        return $this->render('personalisation_marques_pages/index.html.twig', [
            'controller_name' => 'PersonalisationMarquesPagesController',
        ]);
    }
}
