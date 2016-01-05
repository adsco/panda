<?php

namespace Dart\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        $cm = $this->container->get('cart.manager');
        $cart = $cm->getCart();
        $response = new JsonResponse();
        
        $item = $em->getRepository('AppBundle:Meal')->find($id);
        if (null === $item) {
            throw $this->createNotFoundException('Meal with id "' . $id . '" not found');
        }
        
        $cm->add($item);
        $cm->save();
        
        $response->setData(array(
            'success' => true,
            'data' => array(
                'preview' => $this->container->get('preview')->renderCartPreview(true),
                'totalCount' => count($cart->getItems())
            )
        ));
        
        return $response;
    }
    
    /**
     * Remove 1 instance of item from cart
     * 
     * @param integer $id
     */
    public function removeAction($id)
    {
        $response = new JsonResponse();
        
        $cm = $this->container->get('cart.manager');
        $cart = $cm->getCart();
        
        $cart->remove($id, 1);
        $cm->save();
        
        $response->setData(array(
            'success' => true,
            'data' => array(
                'preview' => $this->container->get('preview')->renderCartPreview(true),
                'totalCount' => count($cart->getItems())
            )
        ));
        
        return $response;
    }
    
    /**
     * Remove all instances of item from cart
     * 
     * @param integer $id
     */
    public function removeAllAction($id)
    {
        $response = new JsonResponse();
        
        $cm = $this->container->get('cart.manager');
        $cart = $cm->getCart();
        
        $cart->remove($id);
        $cm->save();
        
        $response->setData(array(
            'success' => true,
            'data' => array(
                'preview' => $this->container->get('preview')->renderCartPreview(true),
                'totalCount' => count($cart->getItems())
            )
        ));
        
        return $response;
    }
    
    /**
     * Render cart preview
     */
    public function previewAction()
    {
        return $this->container->get('preview')->renderCartPreview();
    }
    
    /**
     * Show expanded cart content
     * 
     * @return type
     */
    public function showAction()
    {
        $cm = $this->container->get('cart.manager');
        $cart = $cm->getCart();
        
        return $this->render('AppBundle:Debug:cart.html.twig', array(
            'items' => $cart->getItems()
        ));
    }
}
