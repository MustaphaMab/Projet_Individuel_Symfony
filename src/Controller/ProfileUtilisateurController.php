<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileUtilisateurController extends AbstractController
{
    #[Route("/profile/utilisateur", name: "profile_show", methods: ["GET"])]
    public function show(): Response
    {
        return $this->render('profile_utilisateur/show.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    #[Route("/profile/utilisateur/edit", name: "profile_edit", methods: ["GET", "POST"])]
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('profile_show');
        }

        return $this->render('profile_utilisateur/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route("/profile/utilisateur/delete", name: "profile_delete", methods: ["POST"])]
    public function delete(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $this->getUser()->getId(), $request->request->get('_token'))) {
            $entityManager->remove($this->getUser());
            $entityManager->flush();
            return $this->redirectToRoute('app_logout');
        }

        return $this->redirectToRoute('profile_show');
    }
}
