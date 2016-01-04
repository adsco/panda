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
    protected $delivery;
    
    /**
     * Set delivery cost
     * 
     * @param integer $delivery
     * @return \Dart\AppBundle\Cart\PandaCart
     * @throws \Exception
     */
    public function setDelivery($delivery)
    {
        if (!is_int($delivery)) {
            throw new \Exception('Delivery cost must be integer value');
        } elseif ($delivery < 0) {
            throw new \Exception('Delivery cannot be less than 0');
        }
        
        $this->delivery = $delivery;
        
        return $this;
    }
    
    /**
     * Get cart delivery cost
     * 
     * @return integer
     */
    public function getDelivery()
    {
        return $this->delivery;
    }
    
    /**
     * Get total cart cost
     * 
     * @return integer
     */
    public function getTotal()
    {
        $total = parent::getTotal();
        
        return $total + $this->delivery;
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
