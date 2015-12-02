<?php

namespace Dart\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Dart\AppBundle\Entity\UserProfile;
use Dart\AppBundle\Entity\DeliveryAddress;
use Dart\AppBundle\Entity\Order;
use Dart\AppBundle\Form\Type\OrderType;
use Dart\AppBundle\Form\Type\DeliveryAddressType;
use Dart\AppBundle\Form\Type\UserProfileType;

/**
 * Order controller
 *
 * @package Dart\AppBundle
 * @subpackage Controller
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class OrderController extends Controller
{
    /**
     * Render order preview
     */
    public function showAction()
    {
        $cartService = $this->container->get('cart');
        $orderService = $this->container->get('order');
        
        $order = $orderService->createOrder($cartService->getCart());
        
        return $this->render('AppBundle:Order:show.html.twig', array(
           'order' => $order,
           'form' => $this->createForm(new OrderType(), new Order())->createView()
        ));
    }
    
    /**
     * Submit order to restaurant
     */
    public function submitAction()
    {
        $cartService = $this->container->get('cart');
        $orderService = $this->container->get('order');
        
        $order = $orderService->createOrder($cartService->getCart());
        
        $order->setChange(0);
        
        $orderService->saveOrder($order);
        
        return new Response('ok', 200);
    }
}
