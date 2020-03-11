<?php

namespace App\Form;

use App\Type\AttachmentType;
use App\Entity\Attachment\Attachment;
use App\Entity\Category;
use App\Type\EditorType;
use App\Type\SwitchType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('isOnline', SwitchType::class)
            ->add('slug', TextType::class)
            ->add('image', AttachmentType::class)
            ->add('shortdesc', EditorType::class, [
                'label' => 'Petite description (max 255 charactere)'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
