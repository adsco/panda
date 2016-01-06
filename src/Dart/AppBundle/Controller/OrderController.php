<?php

namespace Dart\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use Dart\AppBundle\Form\Type\CartType;
use Dart\AppBundle\Entity\DeliveryAddress;
use Dart\AppBundle\Entity\OrderUserProfile;
use Dart\AppBundle\Entity\Order;
use Dart\AppBundle\Cart\PandaCart;
use Dart\AppBundle\Form\Type\OrderUserProfileType;
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
        $cart = $this->container->get('cart.manager')->getCart();
        $form = $this->createSubmitOrderForm($cart, new DeliveryAddress(), new OrderUserProfile());
        
        $form->handleRequest($request);
        //order must be created after cart update
        //$order = $this->container->get('order_manager')->createOrder();

        if ($form->isSubmitted() && $form->isValid()) {
            //$this->handleOrderForm($form, $order);
            
            //$this->container->get('cart.manager')->clear(true);
            
            //return $this->redirectToRoute('order_success');
        }
        
        return $this->render('AppBundle:Order:show.html.twig', array(
            //'order' => $order,
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
     * Create order preview form
     * 
     * @param \Dart\AppBundle\Component\PandaCart $cart
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createCartForm(PandaCart $cart)
    {
        $form = $this->createForm(new CartType(), $cart);
        
        return $form;
    }
    
    /**
     * Create delivery address form
     * 
     * @param \Dart\AppBundle\Entity\DeliveryAddress $deliveryAddress
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeliveryAddressForm(DeliveryAddress $deliveryAddress)
    {
        $form = $this->createForm(new DeliveryAddressType(), $deliveryAddress);
        
        return $form;
    }
    
    private function createProfileForm(OrderUserProfile $orderUserProfile)
    {
        $form = $this->createForm(new OrderUserProfileType(), $orderUserProfile);
        
        return $form;
    }
    
    /**
     * Handle order submit
     * 
     * @param \Symfony\Component\Form\FormInterface $form
     * @param \Dart\AppBundle\Entity\Order $order
     */
    private function handleOrderForm(FormInterface $form, Order $order)
    {
        $em = $this->getDoctrine()->getManager();
        
        $address = $form['delivery_address']->getData();
        $profile = $form['user_profile']->getData();
        $change = $form['change']->getData();
        
        $order->setDeliveryAddress($address);
        $order->setOrderUserProfile($profile);
        $order->setChange($change);
        
        $this->fixProducts($order);
        
        $em->persist($order);
        $em->flush();
    }
    
    /**
     * Since product already exists in database, but relation manager
     * asks to persist it, this method will patch it up
     * 
     * @param \Dart\AppBundle\Entity\Order $order
     */
    private function fixProducts(Order $order)
    {
        $em = $this->getDoctrine()->getManager();
        
        foreach ($order->getOrderItems() as $item) {
            $mergedProduct = $em->merge($item->getProduct());
            $item->setProduct($mergedProduct);
        }
    }
}
