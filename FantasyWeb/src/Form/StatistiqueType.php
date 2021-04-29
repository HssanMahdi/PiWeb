<?php

namespace App\Form;

use App\Entity\Joueur;
use App\Entity\Statistique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatistiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('but')
            ->add('assist')
            ->add('clean')
            ->add('numbery')
            ->add('numberr')
            ->add('idJoueur',EntityType::class,['class' => Joueur::class,
                'choice_label' => 'nomJoueur',
                'label' => 'idJoueur']);}



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Statistique::class,
        ]);
    }
}
