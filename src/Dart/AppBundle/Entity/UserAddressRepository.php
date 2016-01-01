<?php

namespace Dart\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Description of UserAddressRepository
 *
 * @package \Dart\AppBundle
 * @subpackage Entity
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class UserAddressRepository extends EntityRepository
{
    public function getUserAddresses($userId, $offset, $limit)
    {
        $query = $this->getEntityManager()
            ->createQueryBuilder('q')
            ->select('address')
            ->from('AppBundle:UserAddress', 'address')
            ->where('address.user_id = :userId')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->setParameter('userId', $userId)
            ->getQuery();
        
        $paginator = new Paginator($query);
        
        return array(
            'result' => $query->getResult(),
            'count' => count($paginator)
        );
    }
}
