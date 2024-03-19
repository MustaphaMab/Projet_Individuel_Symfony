<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SecuriteController extends AbstractController
{
    #[Route('/securite', name: 'app_securite')]
    public function index(): Response
    {
        return $this->render('Admin/securite/index.html.twig', [
            'controller_name' => 'SecuriteController',
        ]);
    }
}
