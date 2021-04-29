<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use League\OAuth2\Client\Provider\GithubResourceOwner;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }


    public function findOrCreateFromGithubOauth (GithubResourceOwner $owner) :User{
        $user=$this->createQueryBuilder('u')
            ->where('u.githubId =: githubId' )
            ->setParameters(
                ['githubId'=>$owner->getId()])
            ->getQuery()
            ->getSingleResult();
            if($user){
                return $user;
            }
            $user=(new User())
            ->setGithubId($owner->getId())
            ->setEmail($owner->getEmail());
            $em=$this->getEntityManager();
            $em->persist($user);
            $em->flush();

            return $user;

    }

    public function findbyEmail($value): ?User
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.email = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
