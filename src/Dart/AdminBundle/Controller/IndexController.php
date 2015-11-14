<?php

namespace Dart\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @package Dart/AdminBundle
 * @subpackage Controller
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class IndexController extends Controller
{
    /**
     * Login page
     */
    public function indexAction()
    {
        return $this->render('AdminBundle:Index:index.html.twig');
    }
}
