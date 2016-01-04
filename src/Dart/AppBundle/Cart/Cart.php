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
            $item->setCount($item->getCount() + $cartItem->getCount());
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
     * @param integer $quantity
     * @return \Dart\AppBundle\Cart\Cart
     */
    public function remove($id, $quantity)
    {
        $item = $this->find($id);
        
        if (!$item) {
            return $this;
        }
        
        if (null !== $quantity) {
            $this->decreaseQuantity($item, $quantity);
        } else {
            $this->unsetItem($item);
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
        if ($index = array_search($cartItem, $haystack)) {
            unset($this->items[$index]);
        }
    }
}
