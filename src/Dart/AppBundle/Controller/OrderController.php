<?php

namespace Dart\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Dart\AppBundle\Entity\Order;
use Dart\AppBundle\Form\Type\OrderType;
use Dart\AppBundle\Form\Type\CartType;
use Dart\AppBundle\Form\Type\DeliveryAddressType;
use Dart\AppBundle\Form\Type\UserProfileType;
use Dart\AppBundle\Entity\DeliveryAddress;
use Dart\AppBundle\Entity\UserProfile;


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
        return $this->render('AppBundle:Order:show.html.twig', array(
            'cartForm' => $this->getCartForm()->createView(),
            'addressForm' => $this->getAddressForm()->createView(),
            'profileForm' => $this->getProfileForm()->createView()
        ));
        
//        return $this->render('AppBundle:Order:show.html.twig', array(
//           'form' => $form->createView()
//        ));
    }
    
    /**
     * Render thank you page
     */
    public function successAction()
    {
        return $this->render('AppBundle:Order:thank_you.html.twig');
    }
    
    private function getCartForm()
    {
        $form = $this->createForm(new CartType(), $this->container->get('cart')->getCart());
        
        return $form;
    }
    
    private function getAddressForm()
    {
        return $this->createForm(new DeliveryAddressType(), new DeliveryAddress());
    }
    
    private function getProfileForm()
    {
        return $this->createForm(new UserProfileType(), new UserProfile());
    }
}
