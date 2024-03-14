<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AcceuilAdminController extends AbstractController
{
    #[Route('/acceuil/admin', name: 'app_acceuil_admin')]
    public function index(): Response
    {
        return $this->render('acceuil_admin/index.html.twig', [
            'controller_name' => 'AcceuilAdminController',
        ]);
    }
}
