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
    public function getId();
    
    public function getPrice();
}
