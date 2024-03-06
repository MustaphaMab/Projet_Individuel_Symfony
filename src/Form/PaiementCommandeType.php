<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\PaiementCommande;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaiementCommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Montant')
            ->add('Methode')
            ->add('Statut')
            ->add('Date')
            ->add('Commande', EntityType::class, [
                'class' => Commande::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PaiementCommande::class,
        ]);
    }
}
