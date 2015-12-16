<?php

namespace Dart\AppBundle\Service;

use Symfony\Component\HttpFoundation\Session\Session;
use Dart\AppBundle\Service\ItemService;
use Dart\AppBundle\Component\Cart;
use Dart\AppBundle\Component\ProductInterface;

/**
 * Cart manager
 *
 * @package \Dart\AppBundle
 * @subpackage Service
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class CartService
{
    /**
     * @var string
     */
    private $name = 'panda-cart';
    
    /**
     * @var \Symfony\Component\HttpFoundation\Session\Session 
     */
    private $session;
    
    /**
     * @var \Dart\AppBundle\Service\ItemService $itemService 
     */
    private $itemService;
    
    /**
     * @var type \Dart\AppBundle\Component\Cart
     */
    private $cart;
    
    /**
     * Constructor
     * 
     * @param \Symfony\Component\HttpFoundation\Session\Session $session
     * @param \Dart\AppBundle\Service\ItemService $itemService
     */
    public function __construct(Session $session, ItemService $itemService)
    {
        $this->session = $session;
        $this->itemService = $itemService;
        $this->cart = $this->getCart();
    }
    
    /**
     * Add item to cart
     * 
     * @param \Dart\AppBundle\Component\ProductInterface $product
     */
    public function addItem(ProductInterface $product)
    {
        $cart = $this->getCart();
        
        $cart->addItem($this->itemService->createItem($product));
        
        $this->saveCart();
    }
    
    /**
     * Remove single instance of product from cart
     * 
     * @param integer $id
     */
    public function removeItem($id)
    {
        $cart = $this->getCart();
        
        $cart->removeItem($id);
        
        $this->saveCart();
    }
    
    /**
     * Remove all instances of product from cart
     * 
     * @param integer $id
     */
    public function removeItemAll($id)
    {
        $cart = $this->getCart();
        
        $cart->removeItem($id, true);
        
        $this->saveCart();
    }
    
    /**
     * Get all products in cart
     * 
     * @return \Dart\AppBundle\Component\ProductInterface[]
     */
    public function getItems()
    {
        $cart = $this->getCart();
        
        return $cart->getItems();
    }
    
    /**
     * Get cart itself
     * 
     * @return \Dart\AppBundle\Component\Cart
     */
    public function getCart()
    {
        if (null === $this->cart) {
            $this->cart = null !== $this->session->get($this->name) ? 
                unserialize($this->session->get($this->name)) : new Cart();
        }
        
        return $this->cart;
    }
    
    /**
     * Remove all items from cart
     * 
     * @param boolean $force save refreshed cart state into session
     */
    public function refresh($force = false)
    {
        $cart = $this->getCart();
        
        $cart->clear();
        
        if ($force) {
            $this->saveCart();
        }
    }

    /**
     * Save cart in session
     * 
     * @return \Dart\AppBundle\Service\CartService
     */
    private function saveCart()
    {
        $this->session->set($this->name, serialize($this->getCart()));
        
        return $this;
    }
}
