<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * Affiche le panier et ses articles. */
    #[Route("/cart", name: "cart_show")]

    public function show(SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        $cart = $session->get('cart', []);
        $products = [];
        foreach ($cart as $id => $quantity) {
            $product = $produitRepository->find($id);
            if ($product) {
                $products[] = ['product' => $product, 'quantity' => $quantity];
            }
        }
        return $this->render('cart/show.html.twig', ['products' => $products]);
    }

    /**
     * Ajoute un produit au panier ou augmente sa quantité, ou diminue la quantité ou supprime un produit du panier. */
    #[Route("/cart/add/{id}", name: "cart_add")]
    #[Route("/cart/remove/{id}", name: "cart_remove")]

    public function updateCart(int $id, SessionInterface $session, string $_route, ProduitRepository $produitRepository): Response
    {
        $cart = $session->get('cart', []);
        if ($_route === 'cart_add') {
            $cart[$id] = ($cart[$id] ?? 0) + 1;
        } elseif ($_route === 'cart_remove' && isset($cart[$id])) {
            $cart[$id]--;
            if ($cart[$id] <= 0) {
                unset($cart[$id]);
            }
        }
        $session->set('cart', $cart);
        return $this->redirectToRoute('cart_show');
    }

    /**
     * Supprime un article du panier. */
    #[Route("/cart/delete/{id}", name: "cart_delete")]

    public function delete(int $id, SessionInterface $session): Response
    {
        $cart = $session->get('cart', []);
        unset($cart[$id]);
        $session->set('cart', $cart);
        return $this->redirectToRoute('cart_show');
    }

    /**
     * Vide complètement le panier. */
    #[Route("/cart/empty", name: "cart_empty")]

    public function empty(SessionInterface $session): Response
    {
        $session->set('cart', []);
        return $this->redirectToRoute('cart_show');
    }
}
