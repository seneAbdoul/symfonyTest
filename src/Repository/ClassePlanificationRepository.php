<?php

namespace App\Repository;

use App\Entity\ClassePlanification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClassePlanification>
 *
 * @method ClassePlanification|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassePlanification|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassePlanification[]    findAll()
 * @method ClassePlanification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassePlanificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClassePlanification::class);
    }

    //    /**
    //     * @return ClassePlanification[] Returns an array of ClassePlanification objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ClassePlanification
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
