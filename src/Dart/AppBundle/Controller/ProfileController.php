<?php

namespace Dart\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;
use Dart\AppBundle\Form\Type\UserAddressType;
use Dart\AppBundle\Form\Type\UserProfileType;
use Dart\AppBundle\Entity\UserAddress;

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
        $profile = $this->getUser()->getProfile();
        $form = $this->createForm(new UserProfileType(), $profile);
        
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($profile);
                $em->flush();
                
                return $this->redirectToRoute('fos_user_profile_show');
            }
        }
        
        return $this->render('AppBundle:Profile:edit.html.twig', array(
           'form' => $form->createView() 
        ));
    }
    
    /**
     * Display address list with form
     */
    public function addressAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $userAddress = new UserAddress();
        $form = $this->createForm(new UserAddressType(), $userAddress);
        
        $addressList = $em->getRepository('AppBundle:UserAddress')->findBy(array(
            'user_id' => $this->getUser()->getId()
        ));
        
        //handle address form
        $this->handleAddressAdd($request, $form, $userAddress);
                
        return $this->render('AppBundle:Profile:address.html.twig', array(
            'form' => $form->createView(),
            'addresses' => $addressList
        ));
    }
    
    /**
     * Edit existing address
     */
    public function addressEditAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $profile = $this->getUser()->getProfile();
        $address = $em->getRepository('AppBundle:UserAddress')->findOneBy(array(
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
        $address = $em->getRepository('AppBundle:UserAddress')->findOneBy(array(
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
    
    /**
     * Handler for address add form
     * 
     * @param Request $request
     * @param FormInterface $form
     * @param UserAddress $userAddress
     */
    private function handleAddressAdd(Request $request, FormInterface $form, UserAddress $userAddress)
    {
        if (!$request->isMethod('POST')) {
            return;
        }
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $userAddress->setUser($this->getUser());

            $em->persist($userAddress);
            $em->flush();
        }
    }
}
