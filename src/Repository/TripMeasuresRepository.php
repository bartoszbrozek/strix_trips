<?php

namespace App\Repository;

use App\Entity\TripMeasures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TripMeasures|null find($id, $lockMode = null, $lockVersion = null)
 * @method TripMeasures|null findOneBy(array $criteria, array $orderBy = null)
 * @method TripMeasures[]    findAll()
 * @method TripMeasures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TripMeasuresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TripMeasures::class);
    }

    // /**
    //  * @return TripMeasures[] Returns an array of TripMeasures objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TripMeasures
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
