<?php

namespace Dart\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\NotBlank;
use Dart\AppBundle\Form\Type\CartItemType;
use Dart\AppBundle\Form\Type\DeliveryAddressType;
use Dart\AppBundle\Form\Type\OrderUserProfileType;

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
            ->add('delivery_address', new DeliveryAddressType(), array(
                'label' => 'Delivery address',
                'mapped' => false,
                'error_bubbling' => true
            ))
            ->add('user_profile', new OrderUserProfileType(), array(
                'label' => 'Personal info',
                'mapped' => false,
                'error_bubbling' => true
            ))
            ->add('change', new IntegerType(), array(
                'label' => 'Change',
                'data' => 0,
                'mapped' => false,
                'constraints' => array(
                    new NotBlank(array()),
                    new Range(array('min' => 0))
                )
            ))
        ;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dart\AppBundle\Component\Cart',
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
