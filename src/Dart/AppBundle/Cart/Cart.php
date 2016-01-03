<?php

namespace Dart\AppBundle\Cart;

use Dart\AppBundle\Cart\Item;

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
     * @var Item[]
     */
    protected $items = array();
    
    /**
     * Added new item to cart
     * 
     * @param CartItem $item
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
     * Get item in cart by item itself or item's id
     * 
     * @param Item $item
     * @return \Dart\AppBundle\Cart\Cart
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
     * @param type $item
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
    
    protected function unsetItem(CartItem $cartItem)
    {
        if ($index = array_search($cartItem, $haystack)) {
            unset($this->items[$index]);
        }
    }
    
    /**
     * Get all items stored in cart
     * 
     * @return Item[]
     */
    public function getItems()
    {
        return $this->items;
    }
    
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
}
