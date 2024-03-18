<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SuperAdminGestionAvanceeController extends AbstractController
{
    #[Route('/super/admin/gestion/avancee', name: 'app_super_admin_gestion_avancee')]
    public function index(): Response
    {
        return $this->render('SuperAdmin/super_admin_gestion_avancee/index.html.twig', [
            'controller_name' => 'SuperAdminGestionAvanceeController',
        ]);
    }
}
