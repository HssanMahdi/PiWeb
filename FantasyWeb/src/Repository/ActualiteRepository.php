<?php


namespace App\Repository;

use App\Entity\Actualites;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Actualites|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actualites|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actualites[]    findAll()
 * @method Actualites[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActualiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Actualites::class);
    }


    public function findactualite($titre){
        return $this->createQueryBuilder('student')
            ->where('Actualite.titre LIKE :titre')
            ->setParameter('titre', '%'.$titre.'%')
            ->getQuery()
            ->getResult();
    }


    /**
     *
     * @return void
     */
    public function countByDate(){

        $query = $this->getEntityManager()->createQuery("
            SELECT SUBSTRING(a.date, 1, 10) as dateActualites, COUNT(a) as count FROM App\Entity\Actualites a GROUP BY dateActualites
        ");
        return $query->getResult();
    }


}