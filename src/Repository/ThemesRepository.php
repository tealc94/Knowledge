<?php

namespace App\Repository;

use App\Entity\Themes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Themes>
 */
class ThemesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Themes::class);
    }

    public function ListThemes()
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.cursuses', 'c')
            ->addSelect('c')
            ->getQuery()
            ->getResult();
    }    
}
