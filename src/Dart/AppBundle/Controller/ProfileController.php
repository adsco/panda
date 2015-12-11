<?php

namespace Dart\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
     * Display address list with form
     */
    public function addressAction()
    {
        return $this->render('AppBundle:Profile:address.html.twig');
    }

    /**
     * Display list of orders
     */
    public function ordersAction()
    {
        return $this->render('AppBundle:Profile:orders.html.twig');
    }
}
