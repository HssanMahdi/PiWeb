<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomUser',TextType::Class,[

                'attr'=>[
                    'placeholder'=> 'Entrer votre nom'
                ]
            ])
            ->add('email',EmailType::class,[

                'attr'=>[
                    'placeholder'=> 'Entrer votre email'
                ]
            ])
            ->add('password', PasswordType::class, [
                'attr'=>[
                    'placeholder'=> 'Entrer votre Password'
                ],

            ])
        ->add('Valider',SubmitType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
