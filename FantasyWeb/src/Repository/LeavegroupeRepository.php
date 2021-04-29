<?php

namespace App\Repository;

use App\Entity\Leavegroupe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Leavegroupe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Leavegroupe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Leavegroupe[]    findAll()
 * @method Leavegroupe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LeavegroupeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Leavegroupe::class);
    }

    // /**
    //  * @return Leavegroupe[] Returns an array of Leavegroupe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Leavegroupe
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findUser($value1,$value2): ?Leavegroupe
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.idGroupe = :val1 AND f.idUser = :val2')
            ->setParameter('val1', $value1)
            ->setParameter('val2', $value2)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

}
