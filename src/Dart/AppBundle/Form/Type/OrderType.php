<?php

namespace Dart\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Dart\AppBundle\Form\Type\DeliveryAddressType;
use Dart\AppBundle\Form\Type\OrderUserProfileType;
use Dart\AppBundle\Form\Type\CartItem;


/**
 * Order form
 *
 * @package \Dart\AppBundle
 * @subpackage Form\Type
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class OrderType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price', new IntegerType(), array(
                'label' => 'Subtotal'
            ))
            ->add('delivery_price', new IntegerType(), array(
                'label' => 'Delivery cost'
            ))
            ->add('order_items', new CollectionType(), array(
                'type' => new CartItem(),
                'label' => 'Products',
                'allow_delete' => true
            ))
            ->add('change', new TextType(), array(
                'label' => 'Change'
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
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dart\AppBundle\Entity\Order'
        ));
    }
    
    public function getName()
    {
        return 'OrderType';
    }
}
