<?php
namespace App\Controller;

use App\Entity\Commande;
use App\Entity\LigneCommande;
use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PaiementCommandeUserController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    #[Route('/checkout', name: 'checkout')]
    public function checkout(EntityManagerInterface $entityManager): Response
    {
        $cart = $this->session->get('cart', []);
        if (empty($cart)) {
            return $this->redirectToRoute('cart_show');
        }

        // Créer une nouvelle commande
        $commande = new Commande();
        $commande->setDates(new \DateTimeImmutable());
        $commande->setCommentaire('Commande fictive pour démonstration');
        $commande->setUsers($this->getUser());

        // Ajouter les produits du panier à la commande
        foreach ($cart as $id => $details) {
            $produit = $entityManager->getRepository(Produit::class)->find($id);
            if ($produit) {
                $ligneCommande = new LigneCommande();
                $ligneCommande->setProduit($produit);
                $ligneCommande->setQuantite($details['quantity']); // Extraire la quantité depuis les détails
                $ligneCommande->setPrixTotal($produit->getPrix() * $details['quantity']);
                $ligneCommande->setCommande($commande);

                $commande->addLigneCommande($ligneCommande);
                $entityManager->persist($ligneCommande);
            }
        }

        $entityManager->persist($commande);
        $entityManager->flush();

        // Vider le panier après la commande
        $this->session->set('cart', []);

        return $this->render('paiement_commande_user/checkout.html.twig', [
            'commande' => $commande,
        ]);
        
    }

    #[Route('/payment/success', name: 'payment_success')]
    public function success(): Response
    {
        return $this->render('payment/success.html.twig');
    }

    #[Route('/payment/cancel', name: 'payment_cancel')]
    public function cancel(): Response
    {
        return $this->render('payment/cancel.html.twig');
    }
}
