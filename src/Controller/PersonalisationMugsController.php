<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonalisationMugsController extends AbstractController
{
    #[Route('/personalisation/mugs', name: 'app_personalisation_mugs')]
    public function index(ProduitRepository $produitRepository): Response {
        $defaultMug = $produitRepository->findOneBy(['nom' => 'Mugs_blanc']);
        
        if (!$defaultMug) {
            throw $this->createNotFoundException('Mug par défaut non trouvé.');
        }

        $mugs = $produitRepository->findBy(['categorie' => $defaultMug->getCategorie()]);

        return $this->render('personalisation_mugs/index.html.twig', [
            'defaultMug' => $defaultMug,
            'mugs' => $mugs
        ]);
    }

    #[Route('/personalisation/mugs/get/{id}', name: 'app_personalisation_mugs_get', methods: ['GET'])]
    public function getMugById(int $id, ProduitRepository $produitRepository): JsonResponse {
        $mug = $produitRepository->find($id);

        if (!$mug) {
            return new JsonResponse(['success' => false, 'message' => 'Aucun mug trouvé.'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(['success' => true, 'mug' => [
            'id' => $mug->getId(),
            'nom' => $mug->getNom(),
            'description' => $mug->getDescription(),
            'photo' => $mug->getPhoto(),
            'prix' => $mug->getPrix(),
            'couleur' => $mug->getCouleur()
        ]]);
    }
}


