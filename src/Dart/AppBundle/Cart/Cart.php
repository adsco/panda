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
    protected $items;
    
    /**
     * Construtor
     */
    public function __construct()
    {
         $this->items = array();
    }
    
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
     * Remove item instances from cart
     * 
     * @param integer $id
     * @param integer|null $quantity
     * @return \Dart\AppBundle\Cart\Cart
     */
    public function remove($id, $quantity = 1)
    {
        $item = $this->find($id);
        
        //fix negative values
        if (!is_int($quantity)) {
            throw new \Exception('Quantity must be integer value');
        }
        
        $quantity = abs($quantity);
        
        if ($quantity >= $item->getQuantity()) {
            $this->removeItem($item);
        } else {
            $item->setQuantity($item->getQuantity() - $quantity);
        }
        
        return $this;
    }
    
    /**
     * Remove item from cart
     * 
     * @param integer|\Dart\AppBundle\Cart\CartItem $id id of item to remove
     * @return \Dart\AppBundle\Cart\PandaCart
     */
    public function removeItem($object)
    {
        if (!$object instanceof CartItem) {
            $item = $this->find($object);
        }
            
        if ($item) {
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
     * Full items update
     * 
     * @param array $items
     * @return \Dart\AppBundle\Cart\Cart
     */
    public function setItems(array $items)
    {
        $this->clear();
        
        foreach ($items as $item) {
            $this->add($item);
        }
        
        return $this;
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
        $this->setItems(unserialize($str));
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
