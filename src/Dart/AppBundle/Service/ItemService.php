<?php

namespace Dart\AppBundle\Service;

use Dart\AppBundle\Component\ProductInterface;
use Dart\AppBundle\Component\CartItemBase;

/**
 * Description of ProductService
 *
 * @author 1
 */
class ItemService
{
    public function createItem(ProductInterface $item)
    {
        return new CartItemBase($item);
    }
}
