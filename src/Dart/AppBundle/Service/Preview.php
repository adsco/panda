<?php

namespace Dart\AppBundle\Service;

use Symfony\Component\Templating\EngineInterface;
use Dart\AppBundle\Service\CartService;

/**
 * Preview service
 *
 * @package \Dart\AppBundle
 * @subpackage Service
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class Preview
{
    /**
     * @var \Symfony\Component\Templating\EngineInterface
     */
    private $templating;
    
    /**
     * @var \Dart\AppBundle\Service\CartService
     */
    private $cart;
    
    /**
     * @var string
     */
    private $template;
    
    /**
     * Constructor
     * 
     * @param \Symfony\Component\Templating\EngineInterface $templating
     * @param \Dart\AppBundle\Service\CartService $cart
     * @param string $template - template name
     */
    public function __construct(EngineInterface $templating, CartService $cart, $template)
    {
        $this->templating = $templating;
        $this->cart = $cart;
        $this->template = $template;
    }

    /**
     * Render cart preview
     * 
     * @param boolean $asString - choice renderResponse|render
     */
    public function renderCartPreview($asString = false)
    {
        $cart = $this->cart->getCart();
        $result = null;
        
        if ($asString) {
            $result = $this->templating->render($this->template, array(
                'items' => $cart->getItems()
            ));
        } else {
            $result = $this->templating->renderResponse($this->template, array(
                'items' => $cart->getItems()
            ));
        }
        
        return $result;
    }
}
