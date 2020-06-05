<?php

namespace App\Repository;

use App\Entity\UserAbonnement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserAbonnement|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserAbonnement|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserAbonnement[]    findAll()
 * @method UserAbonnement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserAbonnementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserAbonnement::class);
    }

    public function getUserAbonnementByUserId($userId)
    {
        return $this->createQueryBuilder('l')
                    ->andWhere('l.user = :val')
                    ->setParameter('val', $userId)
                    ->getQuery()
                    ->getResult()
                    ;
    }

    // /**
    //  * @return UserAbonnement[] Returns an array of UserAbonnement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserAbonnement
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
