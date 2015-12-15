<?php

namespace Dart\AppBundle\Service;

use Dart\AppBundle\Component\ActionInterface;
use Dart\AppBundle\Entity\Order;

/**
 * Delivery action
 *
 * @package \Dart\AppBundle
 * @subpackage Service
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class DeliveryAction implements ActionInterface
{
    /**
     * @var integer
     */
    private $min = 0;

    /**
     * @var integer
     */
    private $cost = 0;
    
    /**
     * Constructor
     * 
     * @param integer $min - minimal order cost
     * @param integer $cost - added cost if minimal order cost not reached
     */
    public function __construct($min, $cost)
    {
        $this->min = $min;
        $this->cost = $cost;
    }
    
    /**
     * {@inheritDoc}
     */
    public function apply(Order $order)
    {
        if ($order->getPrice() < $this->min) {
            $order->setDeliveryPrice($this->cost);
        } else {
            $order->setDeliveryPrice(0);
        }
    }
}
