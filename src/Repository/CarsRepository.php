<?php

namespace App\Repository;

use App\Entity\Cars;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cars>
 *
 * @method Cars|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cars|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cars[]    findAll()
 * @method Cars[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cars::class);
    }

    public function findByFilters($minMileage, $maxMileage, $minReleaseYear, $maxReleaseYear, $minPrice, $maxPrice)
    {
        $query = $this->createQueryBuilder('c');

        if ($minMileage) 
        {
            $query->andWhere('c.mileage >= :minMileage')
                ->setParameter('minMileage', $minMileage);
        }

        if ($maxMileage) {
            $query->andWhere('c.mileage <= :maxMileage')
                ->setParameter('maxMileage', $maxMileage);
        }

        if ($minReleaseYear) {
            $query->andWhere('c.ReleaseYear >= :minReleaseYear')
                ->setParameter('minReleaseYear', $minReleaseYear);
        }

        if ($maxReleaseYear) {
            $query->andWhere('c.ReleaseYear <= :maxReleaseYear')
                ->setParameter('maxReleaseYear', $maxReleaseYear);
        }

        if ($minPrice) {
            $query->andWhere('c.Price >= :minPrice')
                ->setParameter('minPrice', $minPrice);
        }

        if ($maxPrice) {
            $query->andWhere('c.Price <= :maxPrice')
                ->setParameter('maxPrice', $maxPrice);
        }

    return $query->getQuery()->getResult();
    }

//    /**
//     * @return Cars[] Returns an array of Cars objects
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

//    public function findOneBySomeField($value): ?Cars
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
