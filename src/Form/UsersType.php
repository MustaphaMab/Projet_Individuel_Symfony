<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('Nom')
            ->add('Prenom')
            ->add('MdP')
            ->add('Date_Naissance')
            ->add('Telephone')
            ->add('Adresse')
            ->add('email', EmailType::class)
            ->add('Code_Postale')
            ->add('Pays')

            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'User' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                    'Super Admin' => 'ROLE_SUPER_ADMIN',
                ],
                'expanded' => true, // Utilisez des checkboxes.
                'multiple' => true, // Autorise la sélection de plusieurs rôles.
                'label' => 'Rôles',
                // Mappe le tableau de rôles à un tableau attendu par Symfony, si nécessaire
                'mapped' => true,
                'required' => false, // Rend ce champ facultatif
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
