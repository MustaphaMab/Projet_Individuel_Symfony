<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Intl\Countries;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $paysOptions = Countries::getNames();

        $builder
            
        ->add('email', EmailType::class, [
            'label' => 'Email'
        ])
        ->add('Nom', TextType::class, [
            'label' => 'Nom'
        ])
        ->add('Prenom', TextType::class, [
            'label' => 'Prénom'
        ])
        ->add('MdP', PasswordType::class, [
            'label' => 'Mot de passe'
        ])
        ->add('Date_Naissance', DateType::class, [
            'label' => 'Date de naissance',
            'widget' => 'single_text', // Permet à l'utilisateur de choisir une date via un calendrier
            // Ajouter d'autres options comme 'format' si nécessaire
        ])
        ->add('Telephone', TextType::class, [
            'label' => 'Téléphone'
        ])
        ->add('Adresse', TextType::class, [
            'label' => 'Adresse'
        ])
        ->add('Code_Postale', TextType::class, [
            'label' => 'Code postal'
        ])
        ->add('Pays', ChoiceType::class, [
            'choices' => array_flip($paysOptions),
            'label' => 'Pays',
            'choice_translation_domain' => false, // pour éviter la traduction automatique des noms de pays
        ])
        ->add('Ville', ChoiceType::class, [
                'choices' => [
                    'Paris' => 'Paris',
                    'New York' => 'New York',
                    'Montréal' => 'Montréal',
                    // Autres villes...
                ],
                'label' => 'Ville',
            ]);

            // ->add('roles', ChoiceType::class, [
            //     'choices' => [
            //         'User' => 'ROLE_USER',
            //         'Admin' => 'ROLE_ADMIN',
            //         'Super Admin' => 'ROLE_SUPER_ADMIN',
            //     ],
            //     'expanded' => true, // Utilisez des checkboxes.
            //     'multiple' => true, // Autorise la sélection de plusieurs rôles.
            //     'label' => 'Rôles',
            //     // Mappe le tableau de rôles à un tableau attendu par Symfony, si nécessaire
            //     'mapped' => true,
            //     'required' => false, // Rend ce champ facultatif
            // ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
