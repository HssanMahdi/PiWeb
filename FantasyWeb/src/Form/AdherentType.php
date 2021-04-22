<?php

namespace App\Form;

use App\Entity\Adherent;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AdherentType extends AbstractType
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
                    'placeholder'=> 'Entrer votre mdp'
                ],

            ])
            ->add('confirm_password', PasswordType::class,[

                    'attr'=>[
                        'placeholder'=> 'Répetez votre mdp'
                    ]

            ])
              ->add('Valider',SubmitType::class)

        ;


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
