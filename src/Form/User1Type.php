<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class User1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('acceptedAt')
            ->add('term')
            ->add('avatarName')
            ->add('github')
            ->add('instagram')
            ->add('facebook')
            ->add('youtube')
            ->add('country')
            ->add('whatsapp')
            ->add('twitch')
            ->add('groupes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
