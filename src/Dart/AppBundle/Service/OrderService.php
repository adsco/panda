<?php

namespace Dart\AppBundle\Service;

use Dart\AppBundle\Service\OrderItem;
use Dart\AppBundle\Entity\Order;
use Dart\AppBundle\Component\CartItemBase;

/**
 * Order service
 *
 * @package Dart\AppBundle
 * @subpackage Service
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class OrderService
{
    /**
     * @var \Dart\AppBundle\Service\OrderItem
     */
    private $orderItem;
    
    /**
     * Constructor
     * 
     * @param \Dart\AppBundle\Service\OrderItem $orderItem
     */
    public function __construct(OrderItem $orderItem)
    {
        $this->orderItem = $orderItem;
    }
    
    /**
     * Create order
     * 
     * @return \Dart\AppBundle\Entity\Order
     */
    public function create()
    {
        return new Order();
    }
    
    /**
     * Create order item
     * 
     * @param \Dart\AppBundle\Entity\Order $order
     * @param \Dart\AppBundle\Component\CartItemBase $cartItem
     */
    public function createItem(Order $order, CartItemBase $cartItem)
    {
        $item = $this->orderItem->create();
        
        $item->setOrder($order);
        $item->setProduct($cartItem->getProduct());
        $item->setCount($cartItem->getCount());
        
        return $item;
    }
}
