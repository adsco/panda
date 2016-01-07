<?php

namespace Dart\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use Dart\AppBundle\Entity\DeliveryAddress;
use Dart\AppBundle\Entity\OrderUserProfile;
use Dart\AppBundle\Entity\Order;
use Dart\AppBundle\Entity\OrderItem;
use Dart\AppBundle\Entity\Meal;
use Dart\AppBundle\Cart\PandaCart;
use Dart\AppBundle\Form\Type\SubmitOrderType;

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
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function showAction(Request $request)
    {
        $cm   = $this->container->get('cart.manager');
        $cart = $cm->getCart();
        
        //prevent access if cart is empty
        if (count($cart->getItems()) == 0) {
            return $this->redirectToRoute('app_homepage');
        }
        
        $form = $this->createSubmitOrderForm($cart, new DeliveryAddress(), new OrderUserProfile());
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleSubmitForm($form);
            
            //order created, no need to persist cart
            $cart->clear();
            $cm->save();
            
            return $this->redirectToRoute('order_success');
        }
        
        return $this->render('AppBundle:Order:show.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    /**
     * Render thank you page
     */
    public function successAction()
    {
        return $this->render('AppBundle:Order:thank_you.html.twig');
    }
    
    /**
     * Create submit order form
     * 
     * @param mixed[] $data
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createSubmitOrderForm($cart, $deliveryAddress, $userProfile)
    {
        $data = array(
            'cart' => $cart,
            'delivery_address' => $deliveryAddress,
            'user_profile' => $userProfile
        );
        
        $form = $this->createForm(new SubmitOrderType(), $data);
        
        return $form;
    }

    /**
     * Handle order submit
     * 
     * @param \Symfony\Component\Form\FormInterface $form
     */
    private function handleSubmitForm(FormInterface $form)
    {
        $cart = $form['cart']->getData();
        $deliveryAddress = $form['delivery_address']->getData();
        $userProfile = $form['user_profile']->getData();
        $change = $form['change']->getData();
        
        //create managed copies of cart items
        $this->mergeCartProducts($cart);
        
        $order = $this->createOrder($cart, $deliveryAddress, $userProfile, $change);
        
        //explicit set order reference
        $deliveryAddress->setOrder($order);
        $userProfile->setOrder($order);
        
        $this->saveOrder($order);
    }
    
    private function createOrder(
        PandaCart $cart,
        DeliveryAddress $deliveryAddress,
        OrderUserProfile $orderUserProfile,
        $change
    ) {
        $order = new Order();
        
        $order->setDeliveryAddress($deliveryAddress);
        $order->setOrderUserProfile($orderUserProfile);
        $order->setPrice($cart->getTotal());
        $order->setDeliveryPrice($cart->getDelivery());
        $order->setChange($change);
        
        foreach ($cart->getItems() as $item) {
            $orderItem = new OrderItem();
            $orderItem->setProduct($item->getItem());
            $orderItem->setCount($item->getQuantity());
            $orderItem->setOrder($order);
            $order->addOrderItem($orderItem);
        }
        
        return $order;
    }
    
    private function saveOrder(Order $order)
    {
        $em = $this->getDoctrine()->getManager();
        
        $em->persist($order);
        $em->flush();
    }
    
    private function mergeCartProducts(PandaCart $cart)
    {
        foreach ($cart->getItems() as $item) {
            $item->setItem($this->mergeProduct($item->getItem()), $item->getQuantity());
        }
    }
    
    private function mergeProduct(Meal $meal)
    {
        $em = $this->getDoctrine()->getManager();
        
        return $em->merge($meal);
    }
}
