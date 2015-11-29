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
     * Constructor
     * 
     * @param \Symfony\Component\HttpFoundation\Session\Session $session
     * @param \Dart\AppBundle\Service\ItemService $itemService
     */
    public function __construct(Session $session, ItemService $itemService)
    {
        $this->session = $session;
        $this->itemService = $itemService;
        $cart = $this->getCart();
        
        if (null === $cart || !$cart instanceof Cart) {
            $this->session->set($this->name, serialize(new Cart()));
        }
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
        
        $this->saveCart($cart);
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
        
        $this->saveCart($cart);
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
        
        $this->saveCart($cart);
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
        return null !== $this->session->get($this->name) ? 
            unserialize($this->session->get($this->name)) : null;
    }
    
    /**
     * Save cart in session
     * 
     * @param \Dart\AppBundle\Component\Cart $cart
     * @return \Dart\AppBundle\Service\CartService
     */
    private function saveCart(Cart $cart)
    {
        $this->session->set($this->name, serialize($cart));
        
        return $this;
    }
}
