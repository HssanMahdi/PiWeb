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

    public function deleteUserdeGroupe($idu,$idg)
    {

        $query = $this->getEntityManager()
            ->createQuery("DELETE FROM App:Groupeuser c WHERE c.idUser ='$idu' AND c.idGroupe ='$idg'");
        $query->execute();
    }
    public function findUser($value1,$value2): ?Groupeuser
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
