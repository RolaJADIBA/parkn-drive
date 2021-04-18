<?php

namespace App\Repository;

use App\Entity\UsersCars;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UsersCars|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersCars|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersCars[]    findAll()
 * @method UsersCars[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersCarsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsersCars::class);
    }

    // /**
    //  * @return UsersCars[] Returns an array of UsersCars objects
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
    public function findOneBySomeField($value): ?UsersCars
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
