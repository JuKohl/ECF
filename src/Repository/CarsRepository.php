<?php

namespace App\Repository;

use App\Entity\Cars;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

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
    private $paginator;
    
    public function __construct(
        ManagerRegistry $registry, 
        PaginatorInterface $paginator)
    {
        parent::__construct($registry, Cars::class);
        $this->paginator = $paginator;
    }

    public function findMinMaxMileage(): array
    {
        $qb = $this->createQueryBuilder('c');
        $qb->select('MIN(c.mileage) as minMileage, MAX(c.mileage) as maxMileage');
    
        return $qb->getQuery()->getSingleResult();
    }
    
    public function findMinMaxReleaseYear(): array
    {
        $qb = $this->createQueryBuilder('c');
        $qb->select('MIN(c.release_year) as minReleaseYear, MAX(c.release_year) as maxReleaseYear');
    
        return $qb->getQuery()->getSingleResult();
    }
    
    public function findMinMaxPrice(): array
    {
        $qb = $this->createQueryBuilder('c');
        $qb->select('MIN(c.price) as minPrice, MAX(c.price) as maxPrice');
    
        return $qb->getQuery()->getSingleResult();
    }


    public function findFilteredCars ($minMileage, $maxMileage, $minReleaseYear, $maxReleaseYear, $minPrice, $maxPrice) {
        $qb = $this->createQueryBuilder('c');
            if ($minMileage !== null) { 
                $qb->andWhere('c.mileage >= :minMileage')
                ->setParameter('minMileage', $minMileage);
            };
            if ($maxMileage !== null) { 
                $qb->andWhere('c.mileage <= :maxMileage')
                ->setParameter('maxMileage', $maxMileage);
            };
            if ($minReleaseYear !== null) { 
                $qb->andWhere('c.release_year >= :minReleaseYear')
                ->setParameter('minReleaseYear', $minReleaseYear);
            };
            if ($maxReleaseYear !== null) { 
                $qb->andWhere('c.release_year <= :maxReleaseYear')
                ->setParameter('maxReleaseYear', $maxReleaseYear);
            };
            if ($minPrice !== null) { 
                $qb->andWhere('c.price >= :minPrice')
                ->setParameter('minPrice', $minPrice);
            };
            if ($maxPrice !== null) { 
                $qb->andWhere('c.price <= :maxPrice')
                ->setParameter('maxPrice', $maxPrice);
            };
            return $qb->getQuery()->getResult();
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
