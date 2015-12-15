<?php

namespace Dart\AppBundle\Component;

use Dart\AppBundle\Component\ProductInterface;

/**
 * Cart item base
 *
 * @package Dart\AppBundle
 * @subpackage Component
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class CartItemBase
{
    /**
     * @var ProductInterface
     */
    private $product;
    
    /**
     * @var integer
     */
    private $count;
    
    /**
     * Constructor
     */
    public function __construct(ProductInterface $product) {
        $this->product = $product;
        
        $this->count = 1;
    }
    
    /**
     * Unique product identifier
     * 
     * @return string
     */
    public function getId()
    {
        return $this->product->getIdentifier();
    }
    
    /**
     * Retrieve product itself
     * 
     * @return ProductInterface
     */
    public function getProduct()
    {
        return $this->product;
    }
    
    /**
     * Proxy get price method
     * 
     * @return type
     */
    public function getPrice()
    {
        return $this->product->getPrice();
    }
    
    /**
     * Set product count
     * 
     * @param integer $count - product count to set
     */
    public function setCount($count)
    {
        if (!is_int($count) || $count < 1) {
            throw new \Exception('Invalid count, must be positive, greater then zero integer value');
        }
        
        $this->count = $count;
    }
    
    /**
     * Get current product count
     * 
     * @return type
     */
    public function getCount()
    {
        return $this->count;
    }
}
