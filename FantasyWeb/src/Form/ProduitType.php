<?php

namespace App\Form;

use App\Entity\Produit;
use App\Repository\CategorieRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;






class ProduitType extends AbstractType
{
    private $userRepository;
    public  function __construct(CategorieRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idCategorie', ChoiceType::class, [

                'multiple' => false,
                'choices' =>

                    $this->userRepository->createQueryBuilder('u')->select("(u.idCategorie) as id")->getQuery()->getResult(),
                'choice_label' => function ($choice) {
                    return $choice;
                },
            ])

            ->add('nomProduit')
            ->add('nomCategorie', ChoiceType::class, [

                'multiple' => false,
                'choices' =>

                    $this->userRepository->createQueryBuilder('u')->select("(u.nomCategorie) as nom")->getQuery()->getResult(),
                'choice_label' => function ($choice) {
                    return $choice;
                },
            ])
            ->add('prixUnitaire')
            ->add('quantite')

            ->add('image', FileType::class, array('data_class' => null,'required' => false),  [
                'label' => true,

            ])
            ->add('description')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
