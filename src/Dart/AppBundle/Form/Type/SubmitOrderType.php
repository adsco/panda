<?php

namespace Dart\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\Range;
use Dart\AppBundle\Form\Type\CartType;
use Dart\AppBundle\Form\Type\DeliveryAddressType;
use Dart\AppBundle\Form\Type\OrderUserProfileType;

/**
 * Submit order form
 *
 * @package \Dart\AppBundle
 * @subpackage Form\Type
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class SubmitOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cart', new CartType(), array(
                'label' => 'Cart'
            ))
            ->add('delivery_address', new DeliveryAddressType(), array(
                'label' => 'Delivery Address'
            ))
            ->add('user_profile', new OrderUserProfileType(), array(
                'label' => 'User Profile'
            ))
            ->add('change', new IntegerType(), array(
                'label' => 'Change',
                'constraints' => array(
                    new Range(array('min' => 0, 'minMessage' => 'Change cannot be less than 0'))
                )
            ))
        ;
    }
    
    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'cascade_validation' => true,
            'error_bubbling' => true
        ));
    }
    
    public function getName()
    {
        return 'submit_order_form_type';
    }
}
