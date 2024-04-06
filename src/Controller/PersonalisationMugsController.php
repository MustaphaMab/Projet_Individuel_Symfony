<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PersonalisationMugsController extends AbstractController
{
    #[Route('/personalisation/mugs', name: 'app_personalisation_mugs')]
    public function index(): Response
    {
        return $this->render('personalisation_mugs/index.html.twig', [
            'controller_name' => 'PersonalisationMugsController',
        ]);
    }
}
