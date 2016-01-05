<?php

namespace Dart\AppBundle\Service;

use Symfony\Component\HttpFoundation\Session\Session;
use Dart\AppBundle\Cart\PandaCart;
use Dart\AppBundle\Cart\ItemInterface;
use Dart\AppBundle\Service\Cart;

/**
 * CartManager that controlls access to cart and cart saving
 * 
 * @todo think abount: replace cart manager by extending cart, so that cart could be able to save itself
 * 
 * @package \Dart\AppBundle
 * @subpackage Service
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class CartManager
{
    /**
     * @var string
     */
    private $name;
    
    /**
     * @var \Symfony\Component\HttpFoundation\Session\Session
     */
    private $session;
    
    /**
     * @var \Dart\AppBundle\Cart\Cart
     */
    private $cart;
    
    /**
     * @var \Dart\AppBundle\Service\Cart
     */
    private $cartFactory;
    
    /**
     * @var string
     */
    private $cartItemFactory;
    
    /**
     * Constructor
     * 
     * @param string $name
     * @param \Symfony\Component\HttpFoundation\Session\Session $session
     * @param string $cartItemFactoryClass
     */
    public function __construct(Cart $cartFactory, $name, Session $session, $cartItemFactory)
    {
        $this->name = $name;
        $this->session = $session;
        $this->cartFactory = $cartFactory;
        $this->cartItemFactory = $cartItemFactory;
        $this->cart = $this->getCart();
    }
    
    /**
     * Convert \Dart\AppBundle\Cart\ItemInterface into 
     * \Dart\AppBundle\Cart\CartItem and add to cart
     * 
     * @param \Dart\AppBundle\Cart\ItemInterface $item
     * @param integer $quantity
     */
    public function add(ItemInterface $item, $quantity = 1)
    {
        $cartItem = $this->cartItemFactory->create();
        $cartItem->setItem($item);
        $cartItem->setQuantity($quantity);
        
        $this->cart->add($cartItem);
        
        return $this;
    }
    
    /**
     * Get cart
     * 
     * @return \Dart\AppBundle\Cart\Cart 
     */
    public function getCart()
    {
        if (null === $this->cart) {
            $this->cart = $this->cartFactory->create();
            
            if ($cartContent = $this->session->get($this->name)) {
                $this->cart->unserialize($cartContent);
            }
        }
        
        return $this->cart;
    }
    
    /**
     * Save cart in session
     * 
     * @return \Dart\AppBundle\Service\CartManager
     */
    public function save()
    {
        $this->session->set($this->name, $this->cart->serialize());
        
        return $this;
    }
}
