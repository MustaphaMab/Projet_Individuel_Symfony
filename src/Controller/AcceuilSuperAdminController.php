<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AcceuilSuperAdminController extends AbstractController
{
    #[Route('/acceuil/super/admin', name: 'app_acceuil_super_admin')]
    public function index(): Response
    {
        return $this->render('acceuil_super_admin/index.html.twig', [
            'controller_name' => 'AcceuilSuperAdminController',
        ]);
    }
}
