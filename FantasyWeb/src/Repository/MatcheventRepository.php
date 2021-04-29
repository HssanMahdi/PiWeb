<?php

namespace App\Repository;

use App\Entity\Matchevent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Matchevent|null find($id, $lockMode = null, $lockVersion = null)
 * @method Matchevent|null findOneBy(array $criteria, array $orderBy = null)
 * @method Matchevent[]    findAll()
 * @method Matchevent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatcheventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Matchevent::class);
    }

    // /**
    //  * @return Matchevent[] Returns an array of Matchevent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Matchevent
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
