<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\ModCategory;
use App\Entity\Mods;

use App\Entity\User;
use App\Type\EditorType;
use App\Type\UserChoiceType;
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

            ->add('credit', TextType::class)
            ->add('chevaux', TextType::class)
            ->add('slug', TextType::class)
            ->add('model', TextType::class)
            ->add('price', TextType::class)
            ->add('url', TextType::class)
            ->add('option1', TextType::class, [
                'required' => false,
                'label'=> 'Optionelle : Option 1'
            ])
            ->add('option2', TextType::class, [
                'required' => false
            ])
            ->add('option3', TextType::class, [
                'required' => false
            ])
            ->add('certified', CheckboxType::class, [
                'required' => false
            ])
            ->add('withouterrors', CheckboxType::class, [
                'required' => false
            ])
            ->add('colorrims', CheckboxType::class, [
                'required' => false
            ])
            ->add('colorchoice', CheckboxType::class, [
                'required' => false
            ])
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'name',
            ])
            ->add('testedby', UserChoiceType::class)
            ->add('modCategory', EntityType::class, [
                'class' => ModCategory::class,
                'choice_label' => 'name',
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

            ->add('chargeuravant', ChoiceType::class, [
                'choices' =>[
                    'Oui' => "YES",
                   'non' => "no"
                ],
                'expanded' => true,
                'multiple' => true

            ])
            ->add('wheels', ChoiceType::class, [
                'choices' =>[
                    'Michelin' => "michelin",
                    'trellborg' => "trellborg",
                    'mitas' => "mitas",

                ],
                'expanded' => true,
                'multiple' => true
            ])
            ->add('description', EditorType::class, [
                'label' => 'Description'
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
