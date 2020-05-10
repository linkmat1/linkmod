<?php

namespace App\Form;

use App\Core\Data\PostCrudData;
use App\Entity\Attachment\Attachment;
use App\Entity\Category;
use App\Http\Api\Controller\ForumMessageController;
use App\Type\AttachmentType;
use App\Type\CategoryChoiceType;
use App\Type\DateTimeType;
use App\Type\EditorType;
use App\Type\SwitchType;
use App\Type\UserChoiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ForumMessageType extends AbstractType
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ForumMessageController::class,
        ]);
    }
}
