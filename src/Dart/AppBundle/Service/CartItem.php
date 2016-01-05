<?php

namespace Dart\AppBundle\Service;

use Dart\AppBundle\Cart\CartItem;
use Dart\AppBundle\Cart\ItemInterface;

/**
 * Cart item factory
 *
 * @package \Dart\AppBundle
 * @subpackage Service
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class CartItem
{
    /**
     * Cart item factory method
     * 
     * @param \Dart\AppBundle\Cart\ItemInterface $item
     * @param integer $quantity
     * @return \Dart\AppBundle\Cart\CartItem
     */
    public function create(ItemInterface $item, $quantity = 1)
    {
        return new CartItem($item, $quantity);
    }
}
