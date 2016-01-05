<?php

namespace Dart\AppBundle\Service;

use Dart\AppBundle\Service\CartManager;
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
     * @param \Dart\AppBundle\Service\CartManager $cart
     * @param \Dart\AppBundle\Service\OrderService $order
     */
    public function __construct(CartManager $cartManager, OrderService $order, OrderExternals $orderExternals)
    {
        $this->cartManager = $cartManager;
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
        $cart = $this->cartManager->getCart();
        $items = $cart->getItems();
        
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
