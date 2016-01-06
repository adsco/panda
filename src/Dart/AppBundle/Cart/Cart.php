<?php

namespace Dart\AppBundle\Cart;

use Dart\AppBundle\Cart\CartItem;

/**
 * Cart class
 *
 * @package \Dart\AppBundle
 * @subpackage Cart
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class Cart implements \Serializable
{
    /**
     * @var \Dart\AppBundle\Cart\CartItem[]
     */
    protected $items = array();
    
    /**
     * Add new cart item to cart
     * 
     * @param \Dart\AppBundle\Cart\CartItem $cartItem
     * @return \Dart\AppBundle\Cart\Cart
     */
    public function add(CartItem $cartItem)
    {
        if ($item = $this->find($cartItem->getId())) {
            $item->setQuantity($item->getQuantity() + $cartItem->getQuantity());
        } else {
            $this->items[] = $cartItem;
        }
        
        return $this;
    }
    
    /**
     * Get item in cart by item id
     * 
     * @param integer $id
     * @return \Dart\AppBundle\Cart\Cart|null
     * @throws \Exception
     */
    public function find($id)
    {
        //fix integer value
        $id = intval($id);
        
        foreach ($this->items as $item) {
            if ($item->getId() === $id) {
                return $item;
            }
        }
        
        return null;
    }
    
    /**
     * Remove item from cart
     * 
     * @param integer $id
     * @param integer|null $quantity
     * @return \Dart\AppBundle\Cart\Cart
     */
    public function remove($id, $quantity = null)
    {
        $item = $this->find($id);
        
        if (null === $item) {
            return $this;
        }
        
        //fix negative values
        if (is_int($quantity)) {
            $quantity = abs($quantity);
        }
        
        if (null === $quantity || $quantity >= $item->getQuantity()) {
            $this->unsetItem($item);
        } else {
            $item->setQuantity($item->getQuantity() - $quantity);
        }
        
        return $this;
    }
    
    /**
     * Get all items stored in cart
     * 
     * @return \Dart\AppBundle\Cart\CartItem[]
     */
    public function getItems()
    {
        return $this->items;
    }
    
    /**
     * Get total price of all items in cart
     * 
     * @return integer
     */
    public function getTotal()
    {
        $total = 0;
        
        foreach ($this->items as $item) {
            $total += $item->getPrice();
        }
        
        return $total;
    }
    
    /**
     * Remove all items from cart
     * 
     * @return \Dart\AppBundle\Cart\Cart
     */
    public function clear()
    {
        $this->items = array();
        
        return $this;
    }
    
    /**
     * {@inheritDoc}
     */
    public function serialize()
    {
        return serialize($this->items);
    }
    
    /**
     * {@inheritDoc}
     */
    public function unserialize($str)
    {
        $this->items = unserialize($str);
    }
    
    /**
     * Remove all instances of item from cart
     * 
     * @param \Dart\AppBundle\Cart\CartItem $cartItem
     */
    protected function unsetItem(CartItem $cartItem)
    {
        if ($index = array_search($cartItem, $this->items)) {
            unset($this->items[$index]);
        }
    }
}
