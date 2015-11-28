<?php

namespace Dart\AppBundle\Component;

/**
 * Description of ProductBase
 *
 * @author 1
 */
interface ProductInterface {
    public function getIdentifier();
    
    public function getPrice();
    
    public function getName();
    
    public function getDescription();
}
