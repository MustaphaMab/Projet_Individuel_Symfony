<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SuperAdminStrategieController extends AbstractController
{
    #[Route('/super/admin/strategie', name: 'app_super_admin_strategie')]
    public function index(): Response
    {
        return $this->render('super_admin_strategie/index.html.twig', [
            'controller_name' => 'SuperAdminStrategieController',
        ]);
    }
}
