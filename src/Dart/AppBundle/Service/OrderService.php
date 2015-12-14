<?php

namespace Dart\AppBundle\Service;

use Symfony\Component\Form\Form;
use Doctrine\ORM\EntityManager;
use Dart\AppBundle\Component\Cart;
use Dart\AppBundle\Component\CartItemBase;
use Dart\AppBundle\Component\ProductInterface;
use Dart\AppBundle\Entity\OrderUserProfile;
use Dart\AppBundle\Entity\DeliveryAddress;
use Dart\AppBundle\Entity\Order;
use Dart\AppBundle\Entity\OrderItem;
use Dart\AppBundle\Service\CartService;

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
     * @var \Dart\AppBundle\Service\CartService
     */
    private $cartService;
    
    /**
     * Constructor
     * 
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager, CartService $cartService)
    {
        $this->em = $entityManager;
        $this->cartService = $cartService;
    }
    
    /**
     * Get order
     * 
     * @return \Dart\AppBundle\Entity\Order
     */
    public function getOrder()
    {
        return $this->createOrder();
    }
    
    /**
     * Create order
     * 
     * @param \Dart\AppBundle\Component\Cart $cart
     * @param \Dart\AppBundle\Entity\DeliveryAddress $address
     * @return \Dart\AppBundle\Entity\Order
     */
    private function createOrder()
    {
        $cart = $this->cartService->getCart();
        $items = $cart->getItems();
        $order = new Order();
        $totalPrice = $this->getTotalPrice($cart);
        
        $order->setPrice($totalPrice);
        //TODO: delivery price service needed, for delivery price calculation
        $order->setDeliveryPrice(0);
        
        foreach ($items as $item) {
            $order->addOrderItem($this->createOrderItem($order, $item));
        }
        
        return $order;
    }
    
    /**
     * Simple order saving operation
     * 
     * @param \Symfony\Component\Form\Form $form
     */
    public function save(Form $form)
    {
        $order = $this->getOrder();
        $data = $form->getData();
        $deliveryAddress = $data->getDeliveryAddress();
        $orderUserProfile = $data->getOrderUserProfile();
        
        //set up relations to order entity
        $deliveryAddress->setOrder($order);
        $orderUserProfile->setOrder($order);
        
        $order->setDeliveryAddress($deliveryAddress);
        $order->setOrderUserProfile($orderUserProfile);
        $order->setChange($data->getChange());
        
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
        $orderItem->setProduct($product);
        $orderItem->setImage($product->getImage());
        $orderItem->setName($product->getName());
        $orderItem->setPrice($product->getPrice());
        $orderItem->setCount($cartItem->getCount());
        
        return $orderItem;
    }
}
