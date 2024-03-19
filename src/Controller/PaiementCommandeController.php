<?php

namespace App\Controller;

use App\Entity\PaiementCommande;
use App\Form\PaiementCommandeType;
use App\Repository\PaiementCommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/paiement/commande')]
class PaiementCommandeController extends AbstractController
{
    #[Route('/', name: 'app_paiement_commande_index', methods: ['GET'])]
    public function index(PaiementCommandeRepository $paiementCommandeRepository): Response
    {
        return $this->render('Users/paiement_commande/index.html.twig', [
            'paiement_commandes' => $paiementCommandeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_paiement_commande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $paiementCommande = new PaiementCommande();
        $form = $this->createForm(PaiementCommandeType::class, $paiementCommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($paiementCommande);
            $entityManager->flush();

            return $this->redirectToRoute('app_paiement_commande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Users/paiement_commande/new.html.twig', [
            'paiement_commande' => $paiementCommande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_paiement_commande_show', methods: ['GET'])]
    public function show(PaiementCommande $paiementCommande): Response
    {
        return $this->render('Users/paiement_commande/show.html.twig', [
            'paiement_commande' => $paiementCommande,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_paiement_commande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PaiementCommande $paiementCommande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PaiementCommandeType::class, $paiementCommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_paiement_commande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Users/paiement_commande/edit.html.twig', [
            'paiement_commande' => $paiementCommande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_paiement_commande_delete', methods: ['POST'])]
    public function delete(Request $request, PaiementCommande $paiementCommande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paiementCommande->getId(), $request->request->get('_token'))) {
            $entityManager->remove($paiementCommande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_paiement_commande_index', [], Response::HTTP_SEE_OTHER);
    }
}
