<?php

namespace Dart\AppBundle\Component;

use Dart\AppBundle\Component\CartItemBase;

/**
 * Panda cart
 *
 * @package Dart\AppBundle
 * @subpackage Component
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class Cart
{
    /**
     * @var \Dart\AppBundle\Component\CartItemBase[]
     */
    private $items = array();
    
    /**
     * Add item to cart
     * 
     * @param \Dart\AppBundle\Component\CartItemBase $item - item to add
     */
    public function addItem(CartItemBase $item)
    {
        if (array_key_exists($item->getId(), $this->items)) {
            $item = $this->getItem($item->getId());
            $item->setCount($item->getCount() + 1);
        }
        
        $this->items[$item->getId()] = $item;
        
        return $this;
    }
    
    /**
     * Get item by $id
     * 
     * @param \Dart\AppBundle\Component\CartItemBase|integer $item - search item itself or id
     */
    public function getItem($item)
    {
        if ($item instanceof CartItemBase) {
            $id = $item->getId();
        } else {
            $id = $item;
        }
        
        if (!array_key_exists($id, $this->items)) {
            return null;
        }
        
        return $this->items[$id];
    }
    
    /**
     * Remove item with given $id, decrease count by 1
     * 
     * @param \Dart\AppBundle\Component\CartItemBase|integer $id - id of item to remove
     * @param boolean $all - if set to true, all instances of item will be removed
     */
    public function removeItem($id, $all = false)
    {
        $item = $this->getItem($id);
        
        if (!$item) {
            if ($all || $item->getCount() <= 1) {
                unset($this->items[$item->getId()]);
            } else {
                $item->setCount($item->getCount() - 1);
            }
        }
        
        return $this;
    }
    
    /**
     * Get all cart items
     * 
     * @return ProductInterface[]
     */
    public function getItems()
    {
        return $this->items;
    }
    
    /**
     * Remove all items from cart
     * 
     * @return \Dart\AppBundle\Component\Cart
     */
    public function clear()
    {
        $this->items = array();
        
        return $this;
    }
    
    /**
     * Get total products price
     * 
     * @return integer
     */
    public function getTotalPrice()
    {
        $total = 0;
        
        foreach ($this->items as $item) {
            $total += $item->getPrice() * $item->getCount();
        }
        
        return $total;
    }
}
