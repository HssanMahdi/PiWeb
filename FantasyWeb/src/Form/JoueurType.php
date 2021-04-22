<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Joueur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;

class JoueurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomJoueur',TextType::class)
            ->add('prenomJoueur',TextType::class)
            ->add('position',ChoiceType::class,[
                'choices'=> [
                    'ATT' => 'ATT',
                    'MIL' => 'MIL',
                    'DEF' => 'DEF',
                    'G' => 'G',
                ]])
            ->add('scoreJoueur',IntegerType::class)
//            ->add('logoJoueur',FileType::class)

            ->add('logoJoueur',FileType::class,[

// unmapped means that this field is not associated to any entity property
                'mapped' => false,

// make it optional so you don't have to re-upload the PDF file
// every time you edit the Product details
                'required' => false,

// unmapped fields can't define their validation using annotations
// in the associated entity, so you can use the PHP constraint classes
                'attr' => ['class' => 'custom-file-input'],

            ])
            ->add('prixJoueur',IntegerType::class)

        ->add('idEquipe', EntityType::class, [
        'class' => Equipe::class,
        'choice_label' => function (Equipe $equipe) {
            if (!is_null($equipe->getIdEquipe())) {
                return $equipe->getNomEquipe();
            }
        }

    ])
            ->add('Valider', SubmitType::class)
            ->add('captchaCode', CaptchaType::class, array(
                'captchaConfig' => 'ExampleCaptchaUserRegistration',
                'constraints' => [
                    new ValidCaptcha([
                        'message' => 'Invalid captcha, please try again',
                    ]),
                ],
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Joueur::class,
        ]);
    }


}
