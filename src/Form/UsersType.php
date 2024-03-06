<?php

namespace App\Form;

use App\Entity\GestionStock;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Role')
            ->add('Nom')
            ->add('Prenom')
            ->add('MdP')
            ->add('Date_Naissance')
            ->add('Telephone')
            ->add('Adresse')
            ->add('gestionStock', EntityType::class, [
                'class' => GestionStock::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}