<?php

namespace App\Type;


use App\Entity\Category;
use App\Entity\Forums\Tag;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryChoiceType extends EntityType
{

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'class' => Category::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('c')
                    ->where('c.isOnline =  true')
                    ->orderBy('c.name', 'ASC');
            },
            'choice_label' => 'name',
        ]);
    }

}