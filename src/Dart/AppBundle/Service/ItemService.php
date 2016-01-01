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
    
    public function createItems(array $meals)
    {
        $items = array();
        
        foreach ($meals as $meal) {
            if (!$meal instanceof ProductInterface) {
                throw new \Exception('Meal must be instance of ProductInterface');
            }
            
            $items[] = new CartItemBase($meal);
        }
        
        return $items;
    }
}
