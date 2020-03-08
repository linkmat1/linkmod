<?php

namespace App\Form;

use App\Entity\Mods;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description',TextType::class)
            ->add('credit',TextType::class)
            ->add('chevaux',TextType::class)
            ->add('model',TextType::class)
            ->add('price', TextType::class)
            ->add('option1', TextType::class)
            ->add('option2',TextType::class)
            ->add('option3',TextType::class)
            ->add('certified', CheckboxType::class)
            ->add('withouterrors',CheckboxType::class)
            ->add('colorrims',CheckboxType::class)
            ->add('colorchoice',CheckboxType::class)
            ->add('author',EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username',
            ])
            ->add('support', ChoiceType::class, [
                'choices' =>[
                    'PLAY STATION' => "PS4",
                    'XBOX ONE' => "XBOX1",
                    'ORDINATEUR' => "PC",
                    'APPLE' => "mac"
                ],
                'expanded' => true,
                'multiple' => true
            ])

            ->add('chargeuravant',ChoiceType::class, [
                'choices' =>[
                    'Oui' => "YES",
                   'non' => "no"
                ],
                'expanded' => true,
                'multiple' => true

            ])
            ->add('wheels',ChoiceType::class, [
                'choices' =>[
                    'Michelin' => "michelin",
                    'trellborg' => "trellborg",
                    'mitas' => "mitas",

                ],
                'expanded' => true,
                'multiple' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mods::class,
        ]);
    }
}
