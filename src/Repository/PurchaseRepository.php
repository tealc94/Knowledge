<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Cursus;
use App\Entity\Purchase;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Purchase>
 */
class PurchaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Purchase::class);
    }    

    public function countvalidatedLessons(Cursus $cursus, User $user): int
    {
        $qb = $this->createQueryBuilder('p')
            ->select('count(p.id)')
            ->where('p.cursus = :cursus')
            ->andWhere('p.user = :user')
            ->andWhere('p.lesson IS NOT NULL')
            ->setParameter('cursus', $cursus)
            ->setParameter('user', $user);

            return(int) $qb->getQuery()->getSingleScalarResult();
    }

    public function countLessons(Cursus $cursus): int
    {
        $qb = $this->getEntityManager()->createQueryBuilder()
            ->select('count(l.id')
            ->from('App\Entity\Lessons', 'l')
            ->where('l.cursus = :cursus')
            ->setParameter('cursus', $cursus);

            return(int) $qb->getQuery()->getSingleScalarResult();
    }
}
