<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\LigneCommande;
use App\Entity\Produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneCommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ligne_commande')
            ->add('prix_total')
            ->add('Methode')
            ->add('Quantite')
            ->add('Commentaire')
            ->add('commande', EntityType::class, [
                'class' => Commande::class,
'choice_label' => 'id',
            ])
            ->add('Produit', EntityType::class, [
                'class' => Produit::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LigneCommande::class,
        ]);
    }
}
