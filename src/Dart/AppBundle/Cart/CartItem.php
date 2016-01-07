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
    /**
     * @var \Dart\AppBundle\Cart\ItemInterface
     */
    private $item;
    
    /**
     * @var integer
     */
    private $quantity;
    
    /**
     * Constructor
     * 
     * @param \Dart\AppBundle\Cart\ItemInterface|null $item
     * @param integer $quantity
     */
    public function __construct($item = null, $quantity = 1)
    {
        if (null !== $item) {
            $this->setItem($item, $quantity);
        }
    }
    
    /**
     * Set item 
     * 
     * @param \Dart\AppBundle\Cart\ItemInterface $item
     * @param integer $quantity
     * @return \Dart\AppBundle\Cart\CartItem
     */
    public function setItem(ItemInterface $item, $quantity = 1)
    {
        if (null !== $item) {
            $this->item = $item;
            $this->quantity = $quantity;
        }
        
        return $this;
    }
    
    /**
     * Return item id
     * 
     * @return integer
     */
    public function getId()
    {
        return $this->item->getId();
    }
    
    /**
     * Return item
     * 
     * @return \Dart\AppBundle\Cart\ItemInterface
     */
    public function getItem()
    {
        return $this->item;
    }
    
    /**
     * Return item price
     * 
     * @return integer
     */
    public function getUnitPrice()
    {
        return $this->item->getPrice();
    }
    
    /**
     * Return items price
     * 
     * @return integer
     */
    public function getPrice()
    {
        return $this->item->getPrice() * $this->quantity;
    }
    
    /**
     * Return item quantity
     * 
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
    
    /**
     * Set item quantity
     * 
     * @param integer $quantity
     * @throws \Exception
     */
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
