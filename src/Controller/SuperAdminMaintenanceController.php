<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SuperAdminMaintenanceController extends AbstractController
{
    #[Route('/super/admin/maintenance', name: 'app_super_admin_maintenance')]
    public function index(): Response
    {
        return $this->render('super_admin_maintenance/index.html.twig', [
            'controller_name' => 'SuperAdminMaintenanceController',
        ]);
    }
}
