<?php

namespace Dart\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Dart\AppBundle\Form\Type\DeliveryAddressType;
use Dart\AppBundle\Form\Type\UserProfileType;
use Dart\AppBundle\Entity\DeliveryAddress;
use Dart\AppBundle\Entity\UserProfile;

/**
 * Profile controller
 *
 * @package \Dart\AppBundle
 * @subpackage Controller
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class ProfileController extends Controller
{
    
    /**
     * Edit profile
     */
    public function editAction(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(new UserProfileType(), $user->getProfile());
        
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($profile);
                $em->flush();
            }

            return $this->redirectToRoute('profile');
        }
        
        return $this->render('AppBundle:Profile:edit.html.twig', array(
           'form' => $form->createView() 
        ));
    }
    
    /**
     * Display address list with form
     */
    public function addressAction()
    {
        $deliveryAddress = new DeliveryAddress();
        $form = $this->createForm(new DeliveryAddressType(), $deliveryAddress);
                
        return $this->render('AppBundle:Profile:address.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    /**
     * Add new address
     */
    public function addressAddAction(Request $request)
    {
        $deliveryAddress = new DeliveryAddress();
        $form = $this->createForm(new DeliveryAddress(), $deliveryAddress);
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($deliveryAddress);
            $em->flush();
        }
        
        return $this->redirectToRoute('profile_address');
    }
    
    /**
     * Edit existing address
     */
    public function addressEditAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $profile = $this->getUser()->getProfile();
        $address = $em->getRepository('AppBundle:DeliveryAddress')->findOneBy(array(
            'id' => $id,
            'profile_id' => $profile->getId()
        ));
        
        if (!$address) {
            throw $this->createNotFoundException('Address not found');
        }
        
        return $this->render('AppBundle:Profile:address_edit.html.twig', array(
            'address' => $address
        ));
    }
    
    /**
     * Remove existing address
     */
    public function addressRemoveAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $profile = $this->getUser()->getProfile();
        $address = $em->getRepository('AppBundle:DeliveryAddress')->findOneBy(array(
            'id' => $id,
            'profile_id' => $profile->getId()
        ));
        
        if (!$address) {
            throw $this->createNotFoundException('Address not found');
        }
        
        $em->remove($address);
        $em->flush();
        
        return $this->redirectToRoute('profile_address');
    }

    /**
     * Display list of orders
     */
    public function ordersAction()
    {
        return $this->render('AppBundle:Profile:orders.html.twig');
    }
}
