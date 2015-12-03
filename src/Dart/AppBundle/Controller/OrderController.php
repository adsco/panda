<?php

namespace Dart\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
        $order = $this->get('order')->getOrder();
        $form = $this->createForm(new OrderType(), new Order())->createView();
        
        return $this->render('AppBundle:Order:show.html.twig', array(
           'order' => $order,
           'form' => $form
        ));
    }
    
    /**
     * Submit order to restaurant
     */
    public function submitAction(Request $request)
    {
        $form = $this->createForm(new OrderType(), new Order());
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $this->get('order')->save($form);
        }
        
        return new Response('ok', 200);
    }
}
