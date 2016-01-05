<?php

namespace Dart\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Dart\AppBundle\Form\Type\CartItemType;

/**
 * Cart edit form
 *
 * @package \Dart\AppBundle
 * @subpackage Form\Type
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class CartType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('items', 'collection', array(
                'type' => new CartItemType(),
                'allow_delete' => true,
                'allow_add' => false
            ))
            ->add('total')
            ->add('delivery')
        ;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dart\AppBundle\Cart\PandaCart',
            'cascade_validation' => true
        ));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'cart_form_type';
    }
}
