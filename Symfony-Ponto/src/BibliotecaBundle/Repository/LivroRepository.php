<?php

namespace BibliotecaBundle\Repository;

/**
 * LivroRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LivroRepository extends \Doctrine\ORM\EntityRepository
{
	public function findFiveBooks($limit){
		$qb = $this->createQueryBuilder('l')
		->add('orderBy', 'l.id DESC')
		->setMaxResults($limit)
		->getQuery();

        return $qb->execute();	
	}
}