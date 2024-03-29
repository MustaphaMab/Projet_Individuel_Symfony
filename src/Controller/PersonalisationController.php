<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PersonalisationController extends AbstractController
{
    #[Route('/personalisation', name: 'app_personalisation')]
    public function index(): Response
    {
        return $this->render('Users/personalisation/index.html.twig', [
            'controller_name' => 'PersonalisationController',
        ]);
    }
}
