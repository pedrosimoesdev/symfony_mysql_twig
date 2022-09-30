<?php

namespace App\Repository;

use App\Entity\CarsCrudMysql;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarsCrudMysql>
 *
 * @method CarsCrudMysql|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarsCrudMysql|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarsCrudMysql[]    findAll()
 * @method CarsCrudMysql[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarsCrudMysqlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarsCrudMysql::class);
    }

    public function add(CarsCrudMysql $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CarsCrudMysql $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


//    /**
//     * @return CarsCrudMysql[] Returns an array of CarsCrudMysql objects
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

//    public function findOneBySomeField($value): ?CarsCrudMysql
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
