<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Users; // Assurez-vous que le chemin vers votre entité est correct
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UsersFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new Users();
        $user->setNom('Doe');
        $user->setPrenom('John');
        $user->setRole('ROLE_USER'); // Assurez-vous que ce rôle existe dans votre système
        $user->setAdresse('123 Main St, Anytown');
        $user->setTelephone('1234567890');
        $user->setDateNaissance(new \DateTime('1990-01-01'));

        // Hashage du mot de passe avant de le définir
        $user->setMdP($this->passwordEncoder->hashPassword(
            $user,
            'password' // Le mot de passe en clair
        ));

        $manager->persist($user);
        $manager->flush();
    }
}
