<?php

namespace Dart\AppBundle\Service;

/**
 * Cart factory
 *
 * @package \Dart\AppBundle
 * @subpackage Service
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class Cart
{
    /**
     * @var integer
     */
    private $min = 0;
    
    /**
     * @var integer
     */
    private $penalty = 0;

    /**
     * Constructor
     */
    public function __construct($min, $penalty)
    {
        $this->min = $min;
        $this->penalty = $penalty;
    }
    
    public function create()
    {
        return new PandaCart($this->min, $this->penalty);
    }
}
