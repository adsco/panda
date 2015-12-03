<?php

namespace Dart\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Dart\AppBundle\Form\Type\DeliveryAddressType;
use Dart\AppBundle\Form\Type\OrderUserProfileType;


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
            ->add('change', new TextType(), array(
                'label' => 'change'
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
