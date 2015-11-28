<?php

namespace Dart\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Cart controller
 *
 * @package Dart\AppBundle
 * @subpackage Controller
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class CartController extends Controller
{
    /**
     * Add item to cart
     * 
     * @param integer $id
     */
    public function addAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $cartService = $this->container->get('cart');
        
        if (!$item = $em->getRepository('AppBundle:Meal')->findOneBy(array('id' => $id))) {
            throw $this->createNotFoundException('Meal with id "' . $id . '" not found');
        }
        
        $cartService->addItem($item);
        
        return new Response('ok', 200);
    }
    
    /**
     * Remove 1 instance of item from cart
     * 
     * @param integer $id
     */
    public function removeAction($id)
    {
        $cartService = $this->container->get('cart');
        
        $cartService->removeItem($id);
        
        return new Response('ok', 200);
    }
    
    /**
     * Remove all instances of item from cart
     * 
     * @param integer $id
     */
    public function removeAllAction($id)
    {
        $cartService = $this->container->get('cart');
        
        $cartService->removeItemAll($id);
        
        return new Response('ok', 200);
    }
    
    public function showAction()
    {
        $cartService = $this->container->get('cart');
        
        return $this->render('AppBundle:Debug:cart.html.twig', array(
            'items' => $cartService->getItems()
        ));
    }
}
