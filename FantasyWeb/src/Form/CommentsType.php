<?php

namespace App\Form;

use App\Entity\Comments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('nickname',TextType::class,[
                'label'=>'votre pseudo',
                'attr'=>['class'=>'form-control']])
            ->add('email',EmailType::class,[
                'label'=>'votre e-mail',
                'attr'=>['class'=>'form-control']])
            ->add('content',CKEditorType::class,[
                'label'=>'votre commentaires',
                'attr'=>['class'=>'form-control']])

            ->add('rgbd',CheckboxType::class)
            ->add('parent',HiddenType::class)
            ->add('parentid',HiddenType::class,[
                'mapped'=>false
            ])
            ->add('envoyer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comments::class,
        ]);
    }
}
