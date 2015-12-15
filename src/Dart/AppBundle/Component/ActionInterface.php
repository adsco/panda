<?php

namespace Dart\AppBundle\Component;

use Dart\AppBundle\Entity\Order;

/**
 * Action interface
 *
 * @package \Dart\AppBundle
 * @subpackage Component
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
interface ActionInterface
{
    /**
     * Entry point
     * 
     * @param \Dart\AppBundle\Entity\Order $order
     */
    public function apply(Order $order);
}
