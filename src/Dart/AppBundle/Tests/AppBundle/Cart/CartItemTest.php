<?php

namespace Dart\AppBundle\Tests\AppBundle\Cart;

use Symfony\Bundle\FrameworkBundle\Tests\Functional\WebTestCase;
use Dart\AppBundle\Entity\Meal;
use Dart\AppBundle\Cart\CartItem;

/**
 * CartItem unit Test
 * 
 * @todo Replace Meal with mock object
 *
 * @package \Dart\AppBundle
 * @subpackage Tests\AppBundle\Cart
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class ItemTest extends WebTestCase
{
    public function testDefaultConstructor()
    {
        $cartItem = new CartItem($this->getItem());
        
        $this->assertEquals('Dart\AppBundle\Entity\Meal', get_class($cartItem->getItem()), 'Failed to construct CartItem using constructor params');
        $this->assertEquals(1, $cartItem->getQuantity(), 'Failed to set default value in constructor');
    }
    
    public function testParameterizedConstructor()
    {
        $cartItem = new CartItem($this->getItem(), 5);
        
        $this->assertEquals('Dart\AppBundle\Entity\Meal', get_class($cartItem->getItem()), 'Failed to construct CartItem using constructor params');
        $this->assertEquals(5, $cartItem->getQuantity(), 'Failed to set default quantity in constructor');
    }
    
    public function testProperties()
    {
        $cartItem = new CartItem($this->getItem(), 5);
        
        $this->assertEquals(5, $cartItem->getQuantity(), 'Failed to set default quantity in constructor');
        $this->assertEquals(125, $cartItem->getUnitPrice(), 'Get unit price test failed, expected 125, got ' . $cartItem->getUnitPrice());
        $this->assertEquals(625, $cartItem->getPrice(), 'Get price test failed, expected 625, got ' . $cartItem->getPrice());
    }
    
    private function getItem()
    {
        $meal = new Meal();
        $class = new \ReflectionClass('Dart\AppBundle\Entity\Meal');
        $prop = $class->getProperty('id');
        $prop->setAccessible(true);
        
        $prop->setValue($meal, 1);
        $meal->setPrice(125);
        
        return $meal;
    }
}
