<?php

namespace Dart\AppBundle\Cart;

use Dart\AppBundle\Cart\ItemInterface;

/**
 * Cart item class
 *
 * @package \Dart\AppBundle
 * @subpackage Cart
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class CartItem 
{
    private $item;
    
    private $quantity = 0;
    
    public function __construct(ItemInterface $item, $quantity = 1)
    {
        if (null !== $item) {
            $this->item = $item;
            $this->quantity = $quantity;
        }
    }
    
    public function setItem(ItemInterface $item, $quantity = 1)
    {
        if ($this->item) {
            throw new \Exception('Item already set');
        }
        
        if (null !== $item) {
            $this->item = $item;
            $this->quantity = $quantity;
        }
        
        return $this;
    }
    
    public function getId()
    {
        return $this->item->getId();
    }
    
    public function getItem()
    {
        return $this->item;
    }
    
    public function getUnitPrice()
    {
        return $this->item->getPrice();
    }
    
    public function getPrice()
    {
        return $this->item->getPrice() * $this->quantity;
    }
    
    public function getQuantity()
    {
        return $this->quantity;
    }
    
    public function setQuantity($quantity)
    {
        if (!is_int($quantity)) {
            throw new \Exception('Quantity must be integer value');
        } elseif ($quantity < 1) {
            throw new \Exception('Quantity must be positive value greater than 0');
        }
        
        $this->quantity = $quantity;
    }
}
