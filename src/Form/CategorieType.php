<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
// CategorieType herité de AbstractType, 
// et herite des fonctionnalités pour définir la structure d'un formulaire

{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    // buildForm définit les champs du formulaire
    {
        $builder // builder est une instance de FormBuilderInterface
            ->add('Description') // add permet d'ajouter un champ approprié en fonction du type de propriété dans l'entité
            ->add('Nom')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    // configureOption permet de configurer les options pour le formulaire
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class, 
            // je specifie que la class de données par défault est Categorie::class
        ]);
    }
}
