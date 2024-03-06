<?php

namespace App\Repository;

use App\Entity\PaiementCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PaiementCommande>
 *
 * @method PaiementCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaiementCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaiementCommande[]    findAll()
 * @method PaiementCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaiementCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaiementCommande::class);
    }

//    /**
//     * @return PaiementCommande[] Returns an array of PaiementCommande objects
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

//    public function findOneBySomeField($value): ?PaiementCommande
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
