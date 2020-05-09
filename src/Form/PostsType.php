<?php

namespace App\Form;



use App\Core\Data\PostCrudData;
use App\Entity\Category;
use App\Type\DateTimeType;
use App\Type\EditorType;
use App\Type\SwitchType;
use App\Type\UserChoiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostsType extends AbstractType
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content', EditorType::class)
            ->add('isOnline', SwitchType::class)
            ->add('isInfo', SwitchType::class)
            ->add('Info')
            ->add('createdAt', DateTimeType::class)
            ->add('updatedAt', DateTimeType::class)
            ->add('publishAt', DateTimeType::class)
            ->add('source' )
            ->add('deprecated')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name'
            ])
            ->add('isDepre', SwitchType::class)
            ->add('author', UserChoiceType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PostCrudData::class,
        ]);
    }
}
