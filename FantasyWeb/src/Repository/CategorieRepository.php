<?php

namespace App\Repository;

use App\Entity\Categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Locations;

/**
 * @method Categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorie[]    findAll()
 * @method Categorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorie::class);
    }

    public function findCategoriesBySujet($sujet,$status,$order){
        $em = $this->getEntityManager();
        if($order=='DESC') {
            $query = $em->createQuery(
                'SELECT r FROM App\Entity\Categorie r   where r.sujetrec like :suj  and r.statusrec like :status order by r.idrec DESC '
            );
            $query->setParameter('suj', $sujet . '%');
            $query->setParameter('status', $status . '%');
        }
        else{
            $query = $em->createQuery(
                'SELECT r FROM App\Entity\Categorie r   where r.sujetrec like :suj  and r.statusrec like :status order by r.idrec ASC '
            );
            $query->setParameter('suj', $sujet . '%');
            $query->setParameter('status', $status . '%');
        }
        return $query->getResult();
    }
    public function find_Nb_Rec_Par_Status($status){

        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT DISTINCT  count(r.idCategorie) FROM   App\Entity\Categorie r  where r.nomCategorie = :status   '
        );
        $query->setParameter('status', $status);
        return $query->getResult();
    }

    // /**
    //  * @return Categorie[] Returns an array of Categorie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Categorie
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
