<?php

namespace Dart\AppBundle\Cart;

/**
 * Item, meal, product class
 *
 * @package \Dart\AppBundle
 * @subpackage Cart
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
interface ItemInterface
{
    /**
     * return item identifier
     */
    public function getId();
    
    /**
     * return item price
     */
    public function getPrice();
}
