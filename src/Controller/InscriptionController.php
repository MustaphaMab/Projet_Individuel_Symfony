<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class InscriptionController extends AbstractController
{
#[Route('/register', name: 'app_register')]
public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager)
{
    $user = new User();
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Hasher le mot de passe
        $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
        $user->setPassword($hashedPassword);

        $user->setRoles(['ROLE_USER']);

        error_log(print_r($user->getRoles(), true)); 

        $entityManager->persist($user);
        $entityManager->flush();

        // Rediriger vers la page de connexion ou de confirmation
        return $this->redirectToRoute('app_login');
    }


    return $this->render('inscription/index.html.twig', [
    'registrationForm' => $form->createView(),
]);
}

}