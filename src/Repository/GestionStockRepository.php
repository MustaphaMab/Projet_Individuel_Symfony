<?php

namespace App\Repository;

use App\Entity\GestionStock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GestionStock>
 *
 * @method GestionStock|null find($id, $lockMode = null, $lockVersion = null)
 * @method GestionStock|null findOneBy(array $criteria, array $orderBy = null)
 * @method GestionStock[]    findAll()
 * @method GestionStock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GestionStockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GestionStock::class);
    }

//    /**
//     * @return GestionStock[] Returns an array of GestionStock objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GestionStock
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
