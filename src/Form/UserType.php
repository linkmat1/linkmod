<?php

namespace App\Form;

use App\Entity\User;
use App\Type\EditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', HiddenType::class)
            ->add('roles', ChoiceType::class, [
                'choices' =>[
                    'Utilisateur' => "ROLE_USER",
                    'Editor' => "ROLE_EDITOR",
                    'Moderateur' => "ROLE_MODO",
                    'Administrateur' => "ROLE_ADMIN",
                    'Fondateur' => "ROLE_SUPERADMIN"
                ],
                'expanded' => true,
                'multiple' => true
            ])
            ->add('facebook', TextType::class)
            ->add('github', TextType::class)
            ->add('website', TextType::class)
            ->add('instagram', TextType::class)
            ->add('snapshat', TextType::class)
            ->add('bio', EditorType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
