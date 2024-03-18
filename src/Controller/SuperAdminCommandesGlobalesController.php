<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SuperAdminCommandesGlobalesController extends AbstractController
{
    #[Route('/super/admin/commandes/globales', name: 'app_super_admin_commandes_globales')]
    public function index(): Response
    {
        return $this->render('SuperAdmin/super_admin_commandes_globales/index.html.twig', [
            'controller_name' => 'SuperAdminCommandesGlobalesController',
        ]);
    }
}
