<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Content;
use App\Entity\User;
use App\Type\DateTimeType;
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
            ->add('content', TextareaType::class)
            ->add('created_at', DateTimeType::class)
            ->add('isOnline', CheckboxType::class, [
                'label' => 'Publication Public',
                'required' => false
            ])
            ->add('isOk', CheckboxType::class, [
                'label' => 'Validée par un Admin',
                'required' => false,
                'data' => true
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
            ])
            ->add('author', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username',
            ])
            ->add('publish_at', DateTimeType::class)
            ->add('reference', TextType::class, [
                'required' => false,
                'label' => 'Ajoutée une reference'
            ])
            ->add('upnews', CheckboxType::class, [
                'label' => 'A la unes !',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Content::class,
        ]);
    }
}
