<?php

namespace Dart\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

/**
 * Main controller
 * 
 * @package Dart\AppBundle
 * @subpackage Controller
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class IndexController extends Controller
{
    /**
     * Home page display
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Meal')->findBy(array('featured' => true));
        
        return $this->render('AppBundle:Index:index.html.twig', array(
            'products' => $products
        ));
    }
    
    /**
     * Change locale
     */
    public function localeChangeAction(Request $request)
    {
        $referer = $request->headers->get('referer');
        
        if (null !== $referer) {
            return $this->redirect($referer);
        } else {
            return $this->redirectToRoute('app_homepage');
        }
    }

    /**
     * Cuisine page
     * 
     * @param integer id - id of cuisine to display
     * @param integer page - cuisine page to display
     */
    public function cuisineAction($id, $page)
    {
        $em = $this->getDoctrine()->getManager();
        $cuisine = $em->getRepository('AppBundle:Cuisine')->findOneBy(array(
                'id' => $id
            ));
        
        if (null === $cuisine) {
            throw $this->createNotFoundException('Cuisine not found');
        }
        
        return $this->render('AppBundle:Index:cuisine.html.twig', array(
           'cuisine' => $cuisine 
        ));
    }
    
    /**
     * Category page
     * 
     * @param integer $id - selected category id
     * @param integer $page - category page
     */
    public function categoryAction($id, $page)
    {
        $em = $this->getDoctrine()->getManager();
        $resultsPerPage = $this->getParameter('results_per_page');
        $category = $em->getRepository('AppBundle:Category')->find($id);
        
        if (null === $category) {
            throw $this->createNotFoundException('Category not found');
        }
        
        $meals = $em->getRepository('AppBundle:Meal')->getByCategoryId($id, $resultsPerPage * ($page - 1), $resultsPerPage);
        
        return $this->render('AppBundle:Index:category.html.twig', array(
            'page' => $page,
            'last_page' => ceil($meals['count'] / $resultsPerPage),
            'category' => $category,
            'meals' => $meals['result']
        ));
    }
}
