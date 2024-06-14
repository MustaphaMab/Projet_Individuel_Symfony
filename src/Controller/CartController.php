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
        $totalPrice = 0;

        foreach ($cart as $id => $details) {
            if (is_array($details) && isset($details['quantity'], $details['color'])) {
                $product = $produitRepository->find($id);

                if ($product) {
                    $products[] = [
                        'product' => $product,
                        'quantity' => $details['quantity'],
                        'color' => $details['color'],
                        'price' => $product->getPrix(),
                        'subtotal' => $details['quantity'] * $product->getPrix()
                    ];
                    $totalPrice += $details['quantity'] * $product->getPrix();
                }
            }
        }

        return $this->render('cart/show.html.twig', ['products' => $products, 'totalPrice' => $totalPrice]);
    }

    #[Route("/cart/add/{id}", name: "cart_add", methods: ["POST"])]
    public function addToCart(int $id, Request $request, SessionInterface $session, ProduitRepository $produitRepository): JsonResponse {
        $cart = $session->get('cart', []);
        $product = $produitRepository->find($id);

        if ($product) {
            $data = json_decode($request->getContent(), true);
            $color = $data['color'] ?? 'default';

            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += 1;
                $cart[$id]['color'] = $color; // Mise à jour de la couleur
            } else {
                $cart[$id] = ['quantity' => 1, 'color' => $color];
            }

            $session->set('cart', $cart);
            return new JsonResponse(['success' => true, 'cartCount' => array_sum(array_column($cart, 'quantity'))]);
        }

        return new JsonResponse(['success' => false, 'message' => 'Produit non trouvé'], Response::HTTP_NOT_FOUND);
    }

    #[Route("/cart/remove/{id}", name: "cart_remove", methods: ["POST"])]
    public function removeFromCart(int $id, SessionInterface $session): JsonResponse {
        $cart = $session->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(0, $cart[$id]['quantity'] - 1);
            if ($cart[$id]['quantity'] == 0) {
                unset($cart[$id]);
            }
            $session->set('cart', $cart);
            return new JsonResponse(['success' => true, 'cartCount' => array_sum(array_column($cart, 'quantity'))]);
        }

        return new JsonResponse(['success' => false, 'message' => 'Produit non trouvé dans le panier'], Response::HTTP_NOT_FOUND);
    }

    #[Route("/cart/delete/{id}", name: "cart_delete", methods: ["POST"])]
    public function delete(int $id, SessionInterface $session): JsonResponse {
        $cart = $session->get('cart', []);
        unset($cart[$id]);
        $session->set('cart', $cart);
        return new JsonResponse(['success' => true]);
    }

    #[Route("/cart/empty", name: "cart_empty", methods: ["POST"])]
    public function empty(SessionInterface $session): Response {
        $session->set('cart', []);
        return $this->redirectToRoute('cart_show');
    }
}

