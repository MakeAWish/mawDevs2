<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
    public function findAllOrdered()
    {
        $query = $this->createQueryBuilder('d')
            ->addOrderBy('d.name', 'ASC')
            ->addOrderBy('d.weight', 'DESC')
            ->getQuery();

        return $query->getResult();
    }
}