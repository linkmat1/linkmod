<?php

namespace App\Type;

use App\Entity\Attachment\Attachment;
use App\Http\Attachment\AttachmentUrlGenerator;
use App\Http\Attachment\Validator\AttachmentExist;
use App\Http\Attachment\Validator\NonExistingAttachment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttachmentType extends TextType implements DataTransformerInterface
{


    /**
     * @var AttachmentUrlGenerator
     */
    private AttachmentUrlGenerator $attachmentUrlGenerator;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em, AttachmentUrlGenerator $attachmentUrlGenerator)
    {
        $this->em = $em;
        $this->attachmentUrlGenerator = $attachmentUrlGenerator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addViewTransformer($this);
        parent::buildForm($builder, $options);
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['attr']['preview'] = $this->attachmentUrlGenerator->generate($form->getData());
        $view->vars['attr']['overwrite'] = true;
        parent::buildView($view, $form, $options);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'required' => false,
            'attr' => [
                'is' => 'input-attachment',
            ],
            'constraints' => [
                new AttachmentExist()
            ]
        ]);
        parent::configureOptions($resolver);
    }

    /**
     * @param ?Attachment $attachment
     * @return int|null
     */
    public function transform($attachment): ?int
    {
        if ($attachment instanceof Attachment) {
            return $attachment->getId();
        }
        return null;
    }

    /**
     * @param int $value
     * @return Attachment|null
     */
    public function reverseTransform($value): ?Attachment
    {
        if (empty($value)) {
            return null;
        }
        return $this->em->getRepository(Attachment::class)->find($value) ?: new NonExistingAttachment($value);
    }
}



