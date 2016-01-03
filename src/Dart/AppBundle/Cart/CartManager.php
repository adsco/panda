<?php

namespace Dart\AppBundle\Cart;

use Dart\AppBundle\Cart\Cart;

/**
 * Cart manager
 *
 * @package \Dart\AppBundle
 * @subpackage Cart
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class CartManager
{
    /**
     * @var \Dart\AppBundle\Cart\Cart;
     */
    private $cart;
    
    private $deliveryMin;
    
    private $deliveryCost;
    
    private $subtotal;
    
    private $delivery;
    
    private $total;
    
    public function __constructor($deliveryMin, $deliveryCost)
    {
        $this->deliveryMin = $deliveryMin;
        $this->deliveryCost = $deliveryCost;
    }
    
    public function add(Item $item)
    {
        $foundItem = $this->cart->getItem($item);
        
        if ($foundItem) {
            $foundItem->setCount($foundItem->getCount() + 1);
        } else {
            $this->cart->add($item);
        }
        
        $this->updateTotalsAdd($item);
        
        return $this;
    }
    
    public function remove(Item $item)
    {
        if ($foundItem = $this->cart->getItem($item)) {
            $this->cart->removeItem($foundItem);
            
            $this->updateTotalsRemove($foundItem, $foundItem->getCount());
        }
        
        return $this;
    }
    
    public function reset()
    {
        $this->cart->reset();
    }
    
    private function updateTotalsAdd(Item $item, $count = 1)
    {
        $this->subtotal += $item->getPrice() * $count;
        $this->delivery = $this->getDelivery();
        $this->total = $this->subtotal + $this->delivery;
    }
    
    private function updateTotalsRemove(Item $item, $count = 1)
    {
        $this->subtotal -= $item->getPrice() * $count;
        $this->delivery = $this->getDelivery();
        $this->total = $this->subtotal + $this->delivery;
    }
    
    private function getDelivery()
    {
        return $this->subtotal < $this->deliveryMin ? $this->deliveryCost : 0;
    }
}
