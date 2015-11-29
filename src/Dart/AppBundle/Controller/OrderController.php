<?php

namespace Dart\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Dart\AppBundle\Entity\UserProfile;
use Dart\AppBundle\Entity\DeliveryAddress;
use Dart\AppBundle\Entity\Order;

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
           'order' => $order
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
        $order->setProfile($this->getDemoProfile());
        $order->setDeliveryAddress($this->getDemoDeliveryAddress());
        $order->setChange(0);
        
        //TODO: order saving must be moved to order service
        $em->persist($order);
        $em->flush();
        
        return new Response('ok', 200);
    }
    
    private function getDemoProfile()
    {
        $em = $this->getDoctrine()->getManager();
        $profile = new UserProfile();
        
        $users = $em->getRepository('AppBundle:User')->findAll();
        
        $profile->setUser($users[0]);
        $profile->setName('Demo');
        $profile->setPhone('fake phone');
        
        return $profile;
    }
    
    private function getDemoDeliveryAddress()
    {
        $deliveryAddress = new DeliveryAddress();
        
        $deliveryAddress->setApartment(1);
        $deliveryAddress->setBuilding(2);
        $deliveryAddress->setIntercomeCode(3);
        $deliveryAddress->setPorch(4);
        $deliveryAddress->setStreet(5);
        
        return $deliveryAddress;
    }
}
