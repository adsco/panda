<?php

namespace Dart\AppBundle\Service;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Dart\AppBundle\Component\Cart;
use Dart\AppBundle\Component\CartItemBase;
use Dart\AppBundle\Component\ProductInterface;
use Dart\AppBundle\Entity\User;
use Dart\AppBundle\Entity\DeliveryAddress;
use Dart\AppBundle\Entity\Order;
use Dart\AppBundle\Entity\OrderItem;

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
     * Constructor
     */
    public function __construct()
    {
        
    }
    
    /**
     * Create order
     * 
     * @param \Dart\AppBundle\Component\Cart $cart
     * @param \Dart\AppBundle\Entity\DeliveryAddress $address
     * @return \Dart\AppBundle\Entity\Order
     */
    public function createOrder(Cart $cart)
    {
        $items = $cart->getItems();
        $order = new Order();
        
        $order->setPrice($this->getTotalPrice($cart));
        $order->setDeliveryPrice(0);
        
        foreach ($items as $item) {
            $order->addOrderItem($this->createOrderItem($order, $item));
        }
        
        return $order;
    }
    
    /**
     * Calculate total price
     * 
     * @param \Dart\AppBundle\Component\Cart $cart
     * @return integer
     */
    private function getTotalPrice(Cart $cart)
    {
        $items = $cart->getItems();
        $totalPrice = 0;
        
        foreach ($items as $item) {
            $totalPrice += $item->getProduct()->getPrice();
        }
        
        return $totalPrice;
    }
    
    /**
     * Create order item out from CartItemBase
     * 
     * @param \Dart\AppBundle\Service\Order $order
     * @param \Dart\AppBundle\Service\CartItemBase $cartItem
     */
    private function createOrderItem(Order $order, CartItemBase $cartItem)
    {
        $orderItem = new OrderItem();
        $product = $cartItem->getProduct();
        
        $orderItem->setName($product->getName());
        $orderItem->setPrice($product->getPrice());
        $orderItem->setOrder($order);
        
        return $orderItem;
    }
}
