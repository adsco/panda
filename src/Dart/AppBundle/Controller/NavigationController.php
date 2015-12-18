<?php

namespace Dart\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Navigation Controller
 * 
 * @package \Dart\AppBundle
 * @subpackage Controller
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class NavigationController extends Controller
{
    public function menuAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cuisines = $em->getRepository('AppBundle:Cuisine')->findAll();
        
        return $this->render('AppBundle:Navigation:nav_main.html.twig', array(
            'cuisines' => $cuisines
        ));
    }
}
