<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PersonalisationMugsController extends AbstractController
{
    #[Route('/personalisation/mugs', name: 'app_personalisation_mugs')]
    public function index(ProduitRepository $produitRepository): Response
    {
        $mug = $produitRepository->findOneBy(['Categorie' => 1]);

        if(!$mug) {
            throw $this->createNotFoundException('Prix à définir');
        }
        return $this->render('personalisation_mugs/index.html.twig', [
            'controller_name' => 'PersonalisationMugsController',
            'mug' => $mug
        ]);
    }
}
