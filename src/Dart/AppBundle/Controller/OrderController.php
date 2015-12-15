<?php

namespace Dart\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Dart\AppBundle\Entity\Order;
use Dart\AppBundle\Form\Type\OrderType;

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
    public function showAction(Request $request)
    {
        $order = $this->container->get('order_manager')->createOrder();
        $form = $this->createForm(new OrderType(), $order);
        
        if ($request->isMethod('POST') && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();
            
            return $this->render('AppBundle:Order:thank_you.html.twig');
        }
        
        return $this->render('AppBundle:Order:show.html.twig', array(
           'form' => $form->createView()
        ));
    }
}
