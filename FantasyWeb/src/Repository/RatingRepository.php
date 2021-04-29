<?php

namespace App\Repository;

use App\Entity\Rating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rating|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rating|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rating[]    findAll()
 * @method Rating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rating::class);
    }


    // /**
    //  * @return Rating[] Returns an array of Rating objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rating
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function av($id): ?int
    {
        $rating=$this->findBy(array('idJoueur' => $id));
        $totalVol = 0;
        $nbRating= 0;
        $moyenne=0;
        foreach ($rating as $rating) {
            $totalVol = $totalVol + $rating->getRatingvalue();
            $nbRating = $nbRating + 1;
        }
        if($nbRating>0){
        $moyenne=(int) $totalVol/$nbRating;
        }else{
            $moyenne=0;
        }
        return $moyenne;

    }
    public function testExist($idU,$idJ)  {
        $query = $this->getEntityManager()
            ->createQuery("SELECT c FROM App:Rating c WHERE c.idUser ='$idU' AND c.idJoueur = '$idJ' ");
        return $query->getResult();

    }
}
