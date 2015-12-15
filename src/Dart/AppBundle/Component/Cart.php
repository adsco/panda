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
     * @var CartItemBase[]
     */
    private $items = array();
    
    /**
     * Add item to cart
     * 
     * @param CartItemBase $item - item to add
     */
    public function addItem(CartItemBase $item)
    {
        if (array_key_exists($item->getId(), $this->items)) {
            $item = $this->getItem($item->getId());
            $item->setCount($item->getCount() + 1);
        }
        
        $this->items[$item->getId()] = $item;
    }
    
    /**
     * Get item by $id
     * 
     * @param integer $id - id of search item
     */
    public function getItem($id)
    {
        if (!array_key_exists($id, $this->items)) {
            return null;
        }
        
        return $this->items[$id];
    }
    
    /**
     * Remove item with given $id, decrease count by 1
     * 
     * @param integer $id - id of item to remove
     * @param boolean $all - if set to true, all instances of item will be removed
     */
    public function removeItem($id, $all = false)
    {
        $item = $this->getItem($id);
        
        if (!$item) {
            return false;
        }
        
        if ($all || $item->getCount() <= 1) {
            unset($this->items[$id]);
        } else {
            $item->setCount($item->getCount() - 1);
        }
        
        return true;
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
