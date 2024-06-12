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
use Symfony\Component\Security\Core\Security;


class PaiementCommandeUserController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    #[Route('/checkout', name: 'checkout')]
    public function checkout(EntityManagerInterface $entityManager, Security $security): Response
    {
        $cart = $this->session->get('cart', []);
        if (empty($cart)) {
            return $this->redirectToRoute('cart_show');
        }

        // Créer une nouvelle commande
        $commande = new Commande();
        $commande->setDates(new \DateTimeImmutable());
        $commande->setCommentaire('Commande fictive pour démonstration');
        $commande->setUsers($security->getUser());

        // Ajouter les produits du panier à la commande
        foreach ($cart as $id => $quantity) {
            $produit = $entityManager->getRepository(Produit::class)->find($id);
            if ($produit) {
                $ligneCommande = new LigneCommande();
                $ligneCommande->setProduit($produit);
                $ligneCommande->setQuantite($quantity);
                $ligneCommande->setPrixTotal($produit->getPrix() * $quantity);
                $ligneCommande->setCommande($commande);

                $commande->addLigneCommande($ligneCommande);
                $entityManager->persist($ligneCommande);
            }
        }

        $entityManager->persist($commande);
        $entityManager->flush();

        // Vider le panier après la commande
        $this->session->set('cart', []);

        return $this->render('payment/checkout.html.twig', [
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
