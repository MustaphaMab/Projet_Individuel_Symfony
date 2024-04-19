<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PersonalisationMugsController extends AbstractController
{
    #[Route('/personalisation/mugs', name: 'app_personalisation_mugs')]
    public function index(ProduitRepository $produitRepository): Response
    {
        $mug = $produitRepository->findOneBy(['Categorie' => 1]);

        if (!$mug) {
            throw $this->createNotFoundException('Le produit demandé n\'existe pas.');
        }
        return $this->render('personalisation_mugs/index.html.twig', [
            'mug' => $mug
        ]);
    }

    #[Route('/personalisation/mugs/add/{id}', name: 'mug_add_to_cart')]
    public function addToCart($id, SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        $mug = $produitRepository->find($id);
        if (!$mug) {
            throw $this->createNotFoundException('Le produit demandé n\'existe pas.');
        }

        $cart = $session->get('cart', []);
        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }
        $session->set('cart', $cart);

        return $this->redirectToRoute('app_personalisation_mugs');
    }
}


