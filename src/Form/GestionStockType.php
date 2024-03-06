<?php

namespace App\Form;

use App\Entity\GestionStock;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Produit;
use App\Entity\Users;
use App\Entity\Commande;

class GestionStockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Quantite_entree')
            ->add('Quantitee_sortie')
            ->add('Date_creation')
            ->add('Commentaires')

            ->add('Produit', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'nom', // ou une autre propriété significative de l'entité Produit
                'multiple' => true, // Permet de sélectionner plusieurs produits
                'expanded' => false, // false pour une liste déroulante, true pour des cases à cocher
            ])

            ->add('Users', EntityType::class, [
    'class' => Users::class,
    'choice_label' => 'username', // Assure-toi que Users a une propriété `username` ou similaire
    'multiple' => false, // ou true si la relation est ManyToMany
])

->add('Commande', EntityType::class, [
    'class' => Commande::class,
    'choice_label' => 'id', // Utilise une propriété significative de Commande pour l'affichage
    'multiple' => true, // Permet de sélectionner plusieurs commandes
    'expanded' => false, // false pour une liste déroulante, true pour des cases à cocher
]);
                
}


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GestionStock::class,
        ]);
    }
}
