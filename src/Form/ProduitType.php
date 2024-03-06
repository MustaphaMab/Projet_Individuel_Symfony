<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\GestionStock;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('Stock')
            ->add('Description')
            ->add('Photo')
            ->add('Prix')
            ->add('Categorie', EntityType::class, [
                'class' => Categorie::class,
'choice_label' => 'id',
            ])
            ->add('gestionStock', EntityType::class, [
                'class' => GestionStock::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
