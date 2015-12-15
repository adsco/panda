<?php

namespace Dart\AppBundle\Service;

use Dart\AppBundle\Entity\Order;
use Dart\AppBundle\Component\ActionInterface;

/**
 * Order externals, like delivery cost, some order active actions
 *
 * @package \Dart\AppBundle
 * @subpackage Service
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class OrderExternals
{
    /**
     *
     * @var \Dart\AppBundle\Component\ActionInterface[]
     */
    private $actions;
    
    /**
     * Constructor
     * 
     * @param \Dart\AppBundle\Component\ActionInterface[] $actions
     */
    public function __construct(array $actions)
    {
        $this->actions = $actions;
    }
    
    /**
     * Apply actions
     * 
     * @param \Dart\AppBundle\Entity\Order $order
     */
    public function apply(Order $order)
    {
        foreach ($this->actions as $action) {
            $action->apply($order);
        }
    }
}
