<?php

namespace App\Repository;

use App\Entity\ClasseProfesseur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClasseProfesseur>
 *
 * @method ClasseProfesseur|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClasseProfesseur|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClasseProfesseur[]    findAll()
 * @method ClasseProfesseur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClasseProfesseurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClasseProfesseur::class);
    }

//    /**
//     * @return ClasseProfesseur[] Returns an array of ClasseProfesseur objects
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

//    public function findOneBySomeField($value): ?ClasseProfesseur
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
