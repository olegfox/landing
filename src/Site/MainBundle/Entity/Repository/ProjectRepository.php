<?php

namespace Site\MainBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProjectRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjectRepository extends EntityRepository
{
	/**
     * Поиск всех проектов
     *
     * @return array
     */
    public function findAll(){
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'desc')
            ->getQuery()
            ->getResult();
    }
}
