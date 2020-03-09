<?php

namespace App\Form\Forums;

use App\Entity\Forums\ForumCategory;
use App\Entity\Forums\ForumForums;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ForumForumsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('category_id', EntityType::class, [
                'class' => ForumCategory::class,
                'choice_label' => 'title',

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ForumForums::class,
        ]);
    }
}
