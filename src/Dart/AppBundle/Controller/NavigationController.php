<?php

namespace Dart\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavigationController extends Controller
{
    public function CuisineNavigationAction($short = null)
    {
        $em       = $this->getDoctrine()->getManager();
        $cuisines = $em->getRepository('AppBundle:Cuisine')->findAll();
        
        return $this->render('AppBundle:Navigation:nav_cuisine.html.twig', array(
            'cuisines' => $cuisines,
            'dropdown' => $short
        ));
    }
}
