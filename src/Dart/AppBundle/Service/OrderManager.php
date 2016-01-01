<?php

namespace Dart\AppBundle\Service;

use Dart\AppBundle\Service\CartService;
use Dart\AppBundle\Service\OrderService;
use Dart\AppBundle\Service\OrderItem;

/**
 * Order manager
 *
 * @package \Dart\AppBundle
 * @subpackage Service
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class OrderManager
{
    private $em;
    
    private $cart;
    
    private $order;
    
    private $orderExternals;
    
    /**
     * Constructor
     * 
     * @param CartService $cart
     * @param OrderService $order
     */
    public function __construct(CartService $cart, OrderService $order, OrderExternals $orderExternals)
    {
        $this->cart = $cart;
        $this->order = $order;
        $this->orderExternals = $orderExternals;
    }
    
    /**
     * Create order entity
     * 
     * @return \Dart\AppBundle\Entity\Order Description
     */
    public function createOrder()
    {
        $cart = $this->cart->getCart();
        $items = $this->cart->getItems();
        
        $order = $this->addItems($this->order->create(), $items);
        $order->setPrice($cart->getTotalPrice());
        
        $this->orderExternals->apply($order);
        
        return $order;
    }
    
    private function addItems(Order $order, array $items)
    {
        foreach ($items as $item) {
            $order->addOrderItem($this->order->createItem($order, $item));
        }
        
        return $order;
    }
}
