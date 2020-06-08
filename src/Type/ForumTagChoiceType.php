<?php

namespace App\Type;



use App\Domain\Forums\Entity\Tag;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ForumTagChoiceType extends EntityType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'class' => Tag::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('t')
                    ->where('t.parent IS NULL')
                    ->orderBy('t.name', 'ASC');
            },
            'choice_label' => 'name',
        ]);
    }
}
