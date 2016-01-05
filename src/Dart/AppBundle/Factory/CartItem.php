<?php

namespace Dart\AppBundle\Factory;

use Dart\AppBundle\Cart\CartItem as Item;

/**
 * CartItem factory
 *
 * @package \Dart\AppBundle
 * @subpackage Factory
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
