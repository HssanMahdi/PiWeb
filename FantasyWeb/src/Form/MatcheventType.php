<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Matchevent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatcheventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class)
            ->add('idEquipea', EntityType::class, [
                'class' => Equipe::class,
                'choice_label' => function (Equipe $equipe) {
                    if (!is_null($equipe->getIdEquipe())) {
                        return $equipe->getNomEquipe();
                    }
                }

            ])
            ->add('idEquipeb', EntityType::class, [
                'class' => Equipe::class,
                'choice_label' => function (Equipe $equipe) {
                    if (!is_null($equipe->getIdEquipe())) {
                        return $equipe->getNomEquipe();
                    }
                }

            ])
            ->add('datematch',TextType::class)
            ->add('Valider', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Matchevent::class,
        ]);
    }
}
