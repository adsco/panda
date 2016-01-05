<?php

namespace Dart\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Dart\AppBundle\Form\Type\DeliveryAddressType;
use Dart\AppBundle\Form\Type\OrderUserProfileType;
use Dart\AppBundle\Form\Type\CartItemType;

/**
 * Submit form type, used for submitting user cart
 *
 * @package \Dart\AppBundle
 * @subpackage Form\Type
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class SubmitType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('items', new CollectionType(), array(
                'type' => new CartItemType(),
                'label' => 'Products',
                'allow_delete' => true
            ))
            ->add('delivery_address', new DeliveryAddressType(), array(
                'by_reference' => false
            ))
            ->add('order_user_profile', new OrderUserProfileType(), array(
                'by_reference' => false
            ))
        ;
    }
    
    /**
     * {@inherirDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array());
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'cart_submit_form_type';
    }
}
