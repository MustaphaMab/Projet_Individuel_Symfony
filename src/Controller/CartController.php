<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route("/cart", name: "cart_show")]
    public function show(SessionInterface $session, ProduitRepository $produitRepository): Response {
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

    #[Route("/cart/add/{id}", name: "cart_add", methods: ["POST"])]
    public function addToCart(int $id, SessionInterface $session, ProduitRepository $produitRepository, Request $request): Response {
        $cart = $session->get('cart', []);
        $product = $produitRepository->find($id);
        if (!$product) {
            return $this->json(['success' => false, 'message' => 'Produit non trouvé'], Response::HTTP_NOT_FOUND);
        }
        $cart[$id] = ($cart[$id] ?? 0) + 1;
        $session->set('cart', $cart);
        return $this->json(['success' => true, 'cartCount' => array_sum($cart)]);
    }

    #[Route("/cart/remove/{id}", name: "cart_remove", methods: ["POST"])]
    public function removeFromCart(int $id, SessionInterface $session, Request $request): Response {
        $cart = $session->get('cart', []);
        if (!isset($cart[$id])) {
            return $this->json(['success' => false, 'message' => 'Produit non trouvé dans le panier'], Response::HTTP_NOT_FOUND);
        }
        if ($cart[$id] > 1) {
            $cart[$id]--;
        } else {
            unset($cart[$id]);
        }
        $session->set('cart', $cart);
        return $this->json(['success' => true, 'cartCount' => array_sum($cart)]);
    }

    #[Route("/cart/delete/{id}", name: "cart_delete", methods: ["POST"])]
    public function delete(int $id, SessionInterface $session): Response {
        $cart = $session->get('cart', []);
        unset($cart[$id]);
        $session->set('cart', $cart);
        return $this->redirectToRoute('cart_show');
    }

    #[Route("/cart/empty", name: "cart_empty", methods: ["POST"])]
    public function empty(SessionInterface $session): Response {
        $session->set('cart', []);
        return $this->redirectToRoute('cart_show');
    }
}
