<?php

namespace App\Repository;

use App\Entity\Groupeuser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Groupeuser|null find($id, $lockMode = null, $lockVersion = null)
 * @method Groupeuser|null findOneBy(array $criteria, array $orderBy = null)
 * @method Groupeuser[]    findAll()
 * @method Groupeuser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeuserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Groupeuser::class);
    }

    // /**
    //  * @return Groupeuser[] Returns an array of Groupeuser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Groupeuser
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
