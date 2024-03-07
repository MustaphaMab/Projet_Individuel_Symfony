<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\Livraison;
use App\Entity\PaiementCommande;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivraisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Numero_Suivi')
            ->add('Frais_Livraison')
            ->add('Transporteur')
            ->add('Poids_En_Gramme')
            ->add('Commande', EntityType::class, [
                'class' => Commande::class,
'choice_label' => 'id',
            ])
            ->add('Paiement_Commande', EntityType::class, [
                'class' => PaiementCommande::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livraison::class,
        ]);
    }
}
