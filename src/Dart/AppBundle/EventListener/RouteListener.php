<?php

namespace Dart\AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Appends _locale parameter to request
 *
 * @package \Dart\AppBundle
 * @subpackage EventListener
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class RouteListener implements EventSubscriberInterface
{
    /**
     * Constructor
     */
    public function __construct()
    {
        
    }
    
    /**
     * {@inheritDoc}
     */
    public function onRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $locale = $request->get('_locale');
    }
    
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(array('onRequest', 18))
        );
    }
}
