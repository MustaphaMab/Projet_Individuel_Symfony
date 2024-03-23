<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            IntegerField::new('quantite', 'Quantité'),
            DateTimeField::new('dates', 'Date')
                ->setFormat('dd/MM/yyyy HH:mm:ss'),
            TextEditorField::new('commentaire', 'Commentaire'),
            AssociationField::new('users', 'Utilisateur'),
            CollectionField::new('ligneCommandes')
    ->setEntryType(LigneCommandeType::class)
    ->setFormTypeOptions(['by_reference' => false]),

        ];
    }
}
