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
    public function addressAction(Request $request, $page)
    {
        $em = $this->getDoctrine()->getManager();
        $resultsPerPage = $this->getParameter('results_per_page');
        $userAddress = new UserAddress();
        $form = $this->createForm(new UserAddressType(), $userAddress);
        
        //handle address form
        $this->handleAddressAdd($request, $form, $userAddress);
        
        $addresses = $em->getRepository('AppBundle:UserAddress')
            ->getUserAddresses(
                $this->getUser()->getId(),
                $resultsPerPage * ($page - 1),
                $resultsPerPage
            );
        
        return $this->render('AppBundle:Profile:address.html.twig', array(
            'page' => $page,
            'last_page' => ceil($addresses['count'] / $resultsPerPage),
            'form' => $form->createView(),
            'addresses' => $addresses['result']
        ));
    }
    
    /**
     * Edit existing address
     */
    public function addressEditAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $address = $em->getRepository('AppBundle:UserAddress')->findOneBy(array(
            'id' => $id,
            'user_id' => $this->getUser()->getId()
        ));
        
        if (!$address) {
            throw $this->createNotFoundException('Address not found');
        }
        
        $form = $this->createForm(new UserAddressType(), $address);
        
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($address);
            $em->flush();
        }
        
        return $this->render('AppBundle:Profile:address_edit.html.twig', array(
            'address' => $address,
            'form' => $form->createView()
        ));
    }
    
    /**
     * Remove existing address
     */
    public function addressRemoveAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $address = $em->getRepository('AppBundle:UserAddress')->findOneBy(array(
            'id' => $id,
            'user_id' => $this->getUser()->getId()
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
        
        if ($form->isValid() && $form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            
            $userAddress->setUser($this->getUser());

            $em->persist($userAddress);
            $em->flush();
        }
    }
}
