<?php

namespace Dart\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $meals = $em->getRepository('AppBundle:Meal')->findAll();
        
        
        return $this->render('AppBundle:Index:index.html.twig', array(
            'meals' => $meals
        ));
    }
}
