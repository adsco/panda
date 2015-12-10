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
        $cartService = $this->container->get('cart');
        $response = new JsonResponse();
        
        if (!$item = $em->getRepository('AppBundle:Meal')->findOneBy(array('id' => $id))) {
            throw $this->createNotFoundException('Meal with id "' . $id . '" not found');
        }
        
        $cartService->addItem($item);
        
        $response->setData(array(
            'success' => true,
            'data' => array(
                'preview' => $this->container->get('preview')->renderCartPreview(true),
                'totalCount' => count($cartService->getItems())
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
        $cartService = $this->container->get('cart');
        
        return $this->render('AppBundle:Debug:cart.html.twig', array(
            'items' => $cartService->getItems()
        ));
    }
}
