<?php

namespace Dart\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Dart\AppBundle\Entity\UserProfile;
use Dart\AppBundle\Entity\DeliveryAddress;
use Dart\AppBundle\Entity\Order;
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
            'form' => $this->createOrderForm()->createView()
        ));
    }
    
    /**
     * Submit order to restaurant
     */
    public function submitAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cartService = $this->container->get('cart');
        $orderService = $this->container->get('order');
        
        $order = $orderService->createOrder($cartService->getCart());
        $order->setChange(0);
        
        //TODO: order saving must be moved to order service
        $em->persist($order);
        $em->flush();
        
        return new Response('ok', 200);
    }
    
    /**
     * TODO: to be removed
     * 
     * @return type
     */
    private function createOrderForm()
    {
        $order = new Order();
        
        $form = $this->createFormBuilder($order)
            ->add('delivery_address', new DeliveryAddressType())
            ->add('user_profile', new UserProfileType())
            ->getForm();
        
        return $form;
    }
}
