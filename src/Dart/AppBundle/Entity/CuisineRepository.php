<?php

namespace Dart\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Description of CuisineRepository
 *
 * @package \Dart\AppBundle
 * @subpackage Entity
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class CuisineRepository extends EntityRepository
{
    public function getFullMenu()
    {
        $query = $this->getEntityManager()
            ->createQueryBuilder('c')
            ->select('cuisines,categories,meals')
            ->from('AppBundle:Cuisine', 'cuisines')
            ->leftJoin('cuisines.categories', 'categories')
            ->leftJoin('categories.meals', 'meals')
            ->getQuery();
        
        return $query->getArrayResult();
    }
}
