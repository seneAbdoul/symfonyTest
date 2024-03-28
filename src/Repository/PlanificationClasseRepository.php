<?php

namespace App\Repository;

use App\Entity\PlanificationClasse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlanificationClasse>
 *
 * @method PlanificationClasse|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanificationClasse|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanificationClasse[]    findAll()
 * @method PlanificationClasse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanificationClasseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanificationClasse::class);
    }

    //    /**
    //     * @return PlanificationClasse[] Returns an array of PlanificationClasse objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?PlanificationClasse
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
