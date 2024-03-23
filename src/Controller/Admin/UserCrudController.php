<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(), // Cache l'ID lors de la création/édition
            TextField::new('nom', 'Nom'),
            TextField::new('prenom', 'Prénom'),
            TextField::new('mdP', 'Mot de Passe') // Pense à gérer cela de manière sécurisée
                ->hideOnIndex(), // Cache le mot de passe dans l'index
            DateTimeField::new('dateNaissance', 'Date de Naissance')
                ->setFormat('dd/MM/yyyy'), // Format de la date
            TelephoneField::new('telephone', 'Téléphone'),
            TextField::new('adresse', 'Adresse'),
            EmailField::new('email', 'Email'),
            TextField::new('codePostale', 'Code Postal'),
            TextField::new('pays', 'Pays'),
            ArrayField::new('roles', 'Rôles') // Gère les rôles sous forme de tableau
        ];
    }
    
}
