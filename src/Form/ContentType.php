<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Content;
use App\Entity\User;
use App\Type\DateTimeType;
use App\Type\EditorType;
use App\Type\SwitchType;
use App\Type\UserChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('slug', TextType::class)

            ->add('created_at', DateTimeType::class)
            ->add('isOnline', SwitchType::class, [
                'label' => 'Publication Public',
                'required' => false
            ])
            ->add('isOk', SwitchType::class, [
                'label' => 'Validée par Admin',
                'required' => false,
                'data' => true
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
            ])
            ->add('author', UserChoiceType::class)
            ->add('publish_at', DateTimeType::class)
            ->add('reference', TextType::class, [
                'required' => false,
                'label' => 'Ajoutée une reference',
                'attr' => [
                    'placeholder' => 'http://liendusite.fr'
                ]

            ])
            ->add('upnews', SwitchType::class, [
                'label' => 'A la unes !',
                'required' => false
            ])
            ->add('content', EditorType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Content::class,
        ]);
    }
}
