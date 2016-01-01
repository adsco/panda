<?php

namespace Dart\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Custom admin page
 * 
 * @package \Dart\AdminBundle
 * @subpackage Controller
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class IndexController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cuisines = $em->getRepository('AppBundle:Cuisine')->getFullMenu();
        $admin_pool = $this->get('sonata.admin.pool');
        
        return $this->render('AdminBundle:Index:index.html.twig', array(
            'admin_pool' => $admin_pool,
            'cuisines' => $cuisines
        ));
    }
}
