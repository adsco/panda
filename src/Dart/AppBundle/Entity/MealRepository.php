<?php

namespace Dart\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Meal repository
 *
 * @package \Dart\AppBundle
 * @subpackage Entity
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class MealRepository extends EntityRepository
{
    public function getMealsByIds(array $ids)
    {
        $query = $this->getEntityManager()
            ->createQueryBuilder('m')
            ->select('meal')
            ->from('AppBundle:Meal', 'meal')
            ->where('meal.id in (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery();
        
        return $query->getResult();
    }
    
    /**
     * Get meals by category
     * 
     * @param integer $categoryId id of category
     * @param integer $offset offset
     * @param integer $limit limit
     * @return mixed[] returns assoc array with keys: 
     *     "result" - query result
     *     "count" - total count of items
     */
    public function getByCategoryId($categoryId, $offset, $limit)
    {
        $query = $this->getEntityManager()
            ->createQueryBuilder('q')
            ->select('meal')
            ->from('AppBundle:Meal', 'meal')
            ->where('meal.category_id = :id')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->setParameter('id', $categoryId)
            ->getQuery();
        
        $paginator = new Paginator($query);
        
        return array(
            'result' => $query->getResult(),
            'count' => count($paginator)
        );
    }
}
