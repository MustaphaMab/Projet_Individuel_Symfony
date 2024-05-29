<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonalisationMugsController extends AbstractController
{
    #[Route('/personalisation/mugs', name: 'app_personalisation_mugs')]
    /** Affiche les mugs disponibles pour la personnalisation. */
    public function index(ProduitRepository $produitRepository, CategorieRepository $categorieRepository): Response
{
    $categorieMugs = $categorieRepository->findOneBy(['Nom' => 'Mugs']);
    if (!$categorieMugs) {
        throw $this->createNotFoundException('Catégorie Mugs non trouvée.');
    }
    $mugs = $produitRepository->findBy(['Categorie' => $categorieMugs]);

    // Assurez-vous de passer 'id' si nécessaire
    return $this->render('personalisation_mugs/index.html.twig', ['mugs' => $mugs, 'id' => 'some_id_if_needed']);
}


#[Route("/personalisation/mugs/add/{id}", name: "mug_add_to_cart")]
    /** Ajoute un mug au panier. */
    public function addToCart(int $id, SessionInterface $session, ProduitRepository $produitRepository): Response {
        // Trouve le mug spécifique par son ID
        $mug = $produitRepository->find($id);
        
        // Si le mug n'existe pas, renvoie une réponse 404
        if (!$mug) {
            throw $this->createNotFoundException('Le mug demandé n\'existe pas.');
        }

        // Récupère le panier depuis la session, ou initialise un nouveau si aucun panier n'existe
        $cart = $session->get('cart', []);

        // Ajoute ou incrémente la quantité du mug spécifié dans le panier
        $cart[$id] = ($cart[$id] ?? 0) + 1;

        // Enregistre le panier mis à jour dans la session
        $session->set('cart', $cart);

        // Redirige l'utilisateur vers l'affichage du panier
        return $this->redirectToRoute('cart_show');
    }
}
