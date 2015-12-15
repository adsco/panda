<?php

namespace Dart\AppBundle\Service;

use Dart\AppBundle\Entity\Order;
use Dart\AppBundle\Entity\Meal;
use Dart\AppBundle\Entity\OrderItem as OrderItemEntity;

/**
 * Order item handler
 *
 * @package \Dart\Bundle
 * @subpackage Service
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class OrderItem
{
    /**
     * Create OrderItem
     * 
     * @param \Dart\AppBundle\Entity\Order $order
     * @param \Dart\AppBundle\Entity\Meal $meal
     * @return \Dart\AppBundle\Entity\OrderItem
     */
    public function create()
    {
        return new OrderItemEntity();
    }
}
