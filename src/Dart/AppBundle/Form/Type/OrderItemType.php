<?php

namespace Dart\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

/**
 * Order item form type
 *
 * @package \Dart\AppBundle
 * @subpackage Form\Type
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class OrderItemType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('')
        ;
    }
}
