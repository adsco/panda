<?php

namespace Dart\AppBundle\Component;

/**
 * Meal interface used by cart
 *
 * @package \Dart\AppBundle
 * @subpackage Component
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
interface ProductInterface {
    /**
     * Get meal unique identifier, in most cases id
     */
    public function getIdentifier();
    
    /**
     * Get meal price
     * 
     * @return integer meal price
     */
    public function getPrice();
    
    /**
     * Get meal name
     */
    public function getName();
    
    /**
     * Get meal description
     */
    public function getDescription();
    
    /**
     * Get meal image
     */
    public function getImage();
}
