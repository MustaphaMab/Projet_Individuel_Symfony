<?php

namespace App\Controller;

// Importation des classes nécessaires pour le contrôleur
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * Route pour afficher le panier.
     * Cette méthode récupère le contenu du panier depuis la session et passe ces informations à la vue.
     */
    #[Route("/cart", name: "cart_show")]
    public function show(SessionInterface $session, ProduitRepository $produitRepository): Response {
        $cart = $session->get('cart', []); // Obtient le panier actuel ou un tableau vide si rien n'est encore dans le panier
        $products = []; // Initialisation d'un tableau pour stocker les produits et leur quantité
        foreach ($cart as $id => $quantity) { // Boucle sur chaque élément du panier
            $product = $produitRepository->find($id); // Trouve le produit par son ID
            if ($product) { // Si le produit existe
                $products[] = ['product' => $product, 'quantity' => $quantity]; // Ajoute le produit et sa quantité au tableau
            }
        }
        return $this->render('cart/show.html.twig', ['products' => $products]); // Rend la vue du panier avec les produits
    }

    /**
     * Route pour ajouter ou retirer un produit du panier.
     * Cette méthode ajuste la quantité d'un produit dans le panier.
     * Elle peut également renvoyer une réponse JSON pour les requêtes AJAX.
     */
    #[Route("/cart/add/{id}", name: "cart_add")]
    #[Route("/cart/remove/{id}", name: "cart_remove")]
    public function updateCart(int $id, SessionInterface $session, string $_route, ProduitRepository $produitRepository, Request $request): Response {
        $cart = $session->get('cart', []); // Obtient le panier actuel
        if ($_route === 'cart_add') { // Si l'itinéraire est 'cart_add'
            $cart[$id] = ($cart[$id] ?? 0) + 1; // Augmente la quantité du produit
        } elseif ($_route === 'cart_remove' && isset($cart[$id])) { // Si l'itinéraire est 'cart_remove' et que le produit est déjà dans le panier
            $cart[$id]--; // Réduit la quantité du produit
            if ($cart[$id] <= 0) {
                unset($cart[$id]); // Si la quantité est 0 ou moins, retire le produit du panier
            }
        }
        $session->set('cart', $cart); // Sauvegarde le panier mis à jour dans la session

        if ($request->isXmlHttpRequest()) { // Si la requête est une requête AJAX
            return new JsonResponse(['success' => true, 'cartCount' => array_sum($cart)]); // Renvoie une réponse JSON
        } else {
            return $this->redirectToRoute('cart_show'); // Sinon, redirige vers l'affichage du panier
        }
    }

    /**
     * Route pour supprimer complètement un produit du panier.
     * Cette méthode supprime un produit quel que soit le nombre d'unités dans le panier.
     */
    #[Route("/cart/delete/{id}", name: "cart_delete")]
    public function delete(int $id, SessionInterface $session): Response {
        $cart = $session->get('cart', []); // Obtient le panier actuel
        unset($cart[$id]); // Supprime complètement le produit du panier
        $session->set('cart', $cart); // Sauvegarde le panier mis à jour dans la session
        return $this->redirectToRoute('cart_show'); // Redirige vers l'affichage du panier
    }

    /**
     * Route pour vider complètement le panier.
     * Cette méthode supprime tous les produits du panier.
     */
    #[Route("/cart/empty", name: "cart_empty")]
    public function empty(SessionInterface $session): Response {
        $session->set('cart', []); // Réinitialise le panier à un tableau vide
        return $this->redirectToRoute('cart_show'); // Redirige vers l'affichage du panier
    }

    /**
     * Route AJAX spécifique pour ajouter un produit au panier.
     * Cette méthode est similaire à `updateCart` mais dédiée uniquement aux requêtes AJAX.
     */
    #[Route("/cart/ajax/add/{id}", name: "cart_ajax_add")]
    public function ajaxAddToCart(int $id, SessionInterface $session, ProduitRepository $produitRepository): Response {
        $cart = $session->get('cart', []); // Obtient le panier actuel
        $product = $produitRepository->find($id); // Trouve le produit par son ID
        if (!$product) {
            return new JsonResponse(['success' => false, 'message' => 'Produit non trouvé'], 404); // Renvoie une erreur si le produit n'est pas trouvé
        }

        $cart[$id] = ($cart[$id] ?? 0) + 1; // Incrémente la quantité du produit dans le panier
        $session->set('cart', $cart); // Sauvegarde le panier mis à jour dans la session

        return new JsonResponse(['success' => true, 'cartCount' => array_sum($cart)]); // Renvoie une réponse JSON avec le compte du panier
    }
}
