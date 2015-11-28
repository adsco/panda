<?php

namespace Dart\AppBundle\Service;

use Symfony\Component\HttpFoundation\Session\Session;
use Dart\AppBundle\Service\ItemService;
use Dart\AppBundle\Component\Cart;
use Dart\AppBundle\Component\ProductInterface;

/**
 * Cart manager
 *
 * @package Dart\AppBundle
 * @subpackage Service
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class CartService
{
    private $name = 'panda-cart';
    
    private $session;
    
    private $itemService;
    
    /**
     * Constructor
     * 
     * @param Symfony\Component\HttpFoundation\Session\Session $session
     */
    public function __construct(Session $session, ItemService $itemService)
    {
        $this->session = $session;
        $this->itemService = $itemService;
        
        if (!$cart = $this->getCart() || !$cart instanceof Cart) {
            $this->session->set($this->name, serialize(new Cart()));
        }
    }
    
    /**
     * Add item to cart
     * 
     * @param ProductInterface $product
     */
    public function addItem(ProductInterface $product)
    {
        $cart = $this->getCart();
        
        $cart->addItem($this->itemService->createItem($product));
        
        $this->saveCart($cart);
    }
    
    public function removeItem($id)
    {
        $cart = $this->getCart();
        
        $cart->removeItem($id);
        
        $this->saveCart($cart);
    }
    
    public function removeItemAll($id)
    {
        $cart = $this->getCart();
        
        $cart->removeItem($id, true);
        
        $this->saveCart($cart);
    }
    
    public function getItems()
    {
        $cart = $this->getCart();
        
        return $cart->getItems();
    }
    
    private function getCart()
    {
        return $cart = unserialize($this->session->get($this->name));
    }
    
    private function saveCart(Cart $cart)
    {
        $this->session->set($this->name, serialize($cart));
        
        return $this;
    }
}
