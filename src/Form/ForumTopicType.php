<?php

namespace App\Form;

use App\Domain\Forums\Entity\Tag;
use App\Domain\Forums\Entity\Topic;
use App\Type\EditorType;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ForumTopicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('name', TextType::class)
           ->add('tags', EntityType::class, [
                'required' => false,
                'multiple' => true,
                'class' => Tag::class,
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('t')->where('t.parent IS NULL')->orderBy('t.name', 'ASC');
                },
                'choice_label' => 'name',
            ])
      //    ->add('tags',ForumTagChoiceType::class)
            ->add('content', EditorType::class);
    }

    public function configureOptions(OptionsResolver $resolver):void
    {
        $resolver->setDefaults([
            'data_class' => Topic::class,
        ]);
    }
}
