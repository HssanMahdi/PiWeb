<?php

namespace App\Repository;

use App\Entity\Formjoueur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Formjoueur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formjoueur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formjoueur[]    findAll()
 * @method Formjoueur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormjoueurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formjoueur::class);
    }

    // /**
    //  * @return Formjoueur[] Returns an array of Formjoueur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Formjoueur
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
