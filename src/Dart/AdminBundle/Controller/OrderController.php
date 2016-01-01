<?php

namespace Dart\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Dart\AppBundle\Form\Type\OrderType;
use Dart\AppBundle\Entity\Order;

/**
 * Admin order controller
 *
 * @package \Dart\AdminBundle
 * @subpackage Controller
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class OrderController extends Controller
{
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $itemSrv = $this->container->get('cart.item');
        $orderSrv = $this->container->get('order');
        $meals = $request->request->get('meals') ?: array();
        $order = new Order();
        
        $form = $this->createForm(new OrderType(), $order);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            
        }
        
        $order = new Order();
        
        $meals = $em->getRepository('AppBundle:Meal')->getMealsByIds($request->request->get('meals'));
        $items = $itemSrv->createItems($meals);
        
        foreach ($items as $item) {
            $order->addOrderItem($orderSrv->createItem($order, $item));
        }
        
        $form = $this->createForm(new OrderType(), $order);
        
        return $this->render('AdminBundle:Order:create.html.twig', array(
            'admin_pool' => $this->container->get('sonata.admin.pool'),
            'form' => $form->createView()
        ));
    }
}
