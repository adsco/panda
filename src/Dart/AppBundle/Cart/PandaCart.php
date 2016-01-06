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
class PandaCart extends Cart
{
    /**
     * @var integer
     */
    protected $min = 0;
    
    /**
     * @var integer
     */
    protected $penalty = 0;
    
    /**
     * Constructor
     * 
     * @param integer $min
     * @param integer $penalty
     * @throws \Exception
     */
    public function __construct($min, $penalty)
    {
        parent::__construct();
        
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
}
