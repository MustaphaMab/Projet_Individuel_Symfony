<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_users_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('users/index.html.twig', [
            'user' => $userRepository->findAll(),
        ]);
    }

    // CREER

    #[Route('/new', name: 'app_users_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager): Response
{
    $user = new User();
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Vérification avant affectation
        $roles = $form->get('roles')->getData(); // Assure-toi que ton formulaire a un champ 'roles'
        if ($roles !== null) {
            $user->setRoles($roles);
        } else {
            $user->setRoles([]);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('users/new.html.twig', [
        'user' => $user,
        'form' => $form,
    ]);
}


    #[Route('/{id}', name: 'app_users_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('users/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_users_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
{
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Vérification avant affectation
        $roles = $form->get('roles')->getData(); // Assure-toi que ton formulaire a un champ 'roles'
        if ($roles !== null) {
            $user->setRoles($roles);
        } else {
            $user->setRoles([]);
        }

        $entityManager->flush();

        return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('users/edit.html.twig', [
        'user' => $user,
        'form' => $form,
    ]);
}


    #[Route('/{id}', name: 'app_users_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
    }
}
