<?php

namespace Dart\AppBundle\Service;

use Dart\AppBundle\Cart\CartItem as Item;

/**
 * CartItem factory
 *
 * @package \Dart\AppBundle
 * @subpackage Service
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class CartItem
{
    /**
     * Factory method
     * 
     * @return \Dart\AppBundle\Cart\CartItem
     */
    public function create()
    {
        return new Item();
    }
}
