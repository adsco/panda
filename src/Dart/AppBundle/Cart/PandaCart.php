<?php

namespace Dart\AppBundle\Cart;

use Dart\AppBundle\Cart\Cart;

/**
 * Panda cart class
 *
 * @package \Dart\AppBundle
 * @subpackage Cart
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class PandaCart extends Cart implements \Serializable
{
    /**
     * @var integer
     */
    protected $delivery = 0;
    
    /**
     * @var integer
     */
    protected $min = 0;
    
    /**
     * @var integer
     */
    protected $penalty = 0;
    
    public function __constructor($min, $penalty)
    {
        if (!is_int($min) || $min < 0) {
            throw new \Exception('$min must be integer, equal or greater than 0');
        }
        
        if (!is_int($penalty) || $penalty < 0) {
            throw new \Exception('$penalty must be integer, equal or greater than 0');
        }
        
        $this->min = $min;
        $this->penalty = $penalty;
    }
    
    /**
     * Get cart delivery cost
     * 
     * @return integer
     */
    public function getDelivery()
    {
        return $this->getTotal() >= $this->min ? 0 : $this->penalty;
    }
    
    /**
     * {@inheritDoc}
     */
    public function serialize()
    {
        return serialize(array(
            'items' => $this->items,
            'delivery' => $this->delivery
        ));
    }
    
    /**
     * {@inheritDoc}
     */
    public function unserialize($str)
    {
        $data = unserialize($str);
        
        $this->items = $data['items'];
        $this->delivery = $data['delivery'];
    }
}
