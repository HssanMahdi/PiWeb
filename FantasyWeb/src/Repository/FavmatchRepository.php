<?php

namespace App\Repository;

use App\Entity\Favmatch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Favmatch|null find($id, $lockMode = null, $lockVersion = null)
 * @method Favmatch|null findOneBy(array $criteria, array $orderBy = null)
 * @method Favmatch[]    findAll()
 * @method Favmatch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavmatchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Favmatch::class);
    }

    // /**
    //  * @return Favmatch[] Returns an array of Favmatch objects
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
    public function findOneBySomeField($value): ?Favmatch
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function deletefav($id2)
    {
        $query = $this->getEntityManager()
            ->createQuery("DELETE FROM App:Favmatch c WHERE c.idmatch='$id2' ");
        $query->execute();

    }
}
