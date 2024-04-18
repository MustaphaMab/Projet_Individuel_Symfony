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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


#[Route('/users')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $usersRepository): Response
    {
        return $this->render('Admin/user/index.html.twig', [
            'users' => $usersRepository->findAll(),
        ]);
    }

    // CREER

    #[Route('/new', name: 'app_users_new', methods: ['GET', 'POST'])]
public function new(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
{
    $user = new User();
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
        $user->setPassword($hashedPassword);
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'Utilisateur créé avec succès!');

        return $this->redirectToRoute('app_user_index');
    }

    return $this->render('Admin/user/new.html.twig', [
        'user' => $user,
        'form' => $form->createView(),
    ]);
}


    #[Route('/{id}', name: 'app_users_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('Admin/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_users_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
{
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

        $this->addFlash('success', 'Les modifications ont été enregistrées avec succès!');

        return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('Admin/user/edit.html.twig', [
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

        $this->addFlash('success', 'Utilisateur supprimé avec succès!');
    }

    return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
}

}
