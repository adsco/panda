<?php

namespace Dart\AppBundle\Service;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityManager;
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
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    
    /**
     * Constructor
     * 
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
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
        $totalPrice = $this->getTotalPrice($cart);
        
        $order->setPrice($totalPrice);
        
        foreach ($items as $item) {
            $order->addOrderItem($this->createOrderItem($order, $item));
        }
        
        return $order;
    }
    
    /**
     * Simple order saving operation
     * 
     * @param Order $order
     */
    public function saveOrder(Order $order)
    {
        $this->em->persist($order);
        $this->em->flush();
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
            $totalPrice += $item->getProduct()->getPrice() * $item->getCount();
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
        
        $orderItem->setOrder($order);
        $orderItem->setName($product->getName());
        $orderItem->setPrice($product->getPrice());
        $orderItem->setCount($cartItem->getCount());
        
        return $orderItem;
    }
}
