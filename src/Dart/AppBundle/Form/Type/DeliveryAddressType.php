<?php

namespace Dart\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Form for \Dart\AppBundle\Entity\DeliveryAddress
 *
 * @package \Dart\AppBundle
 * @subpackage Form\Type
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class DeliveryAddressType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('street', new TextType(), array(
                'label' => 'Street'
            ))
            ->add('building', new TextType(), array(
                'label' => 'Building'
            ))
            ->add('porch', new IntegerType(), array(
                'label' => 'Porch'
            ))
            ->add('apartment', new IntegerType(), array(
                'label' => 'Apartment'
            ))
            ->add('intercome_code', new TextType(), array(
                'label' => 'Intercome code'
            ))
            ->add('note', new TextareaType(), array(
                'label' => 'Note'
            ))
        ;
    }
    
    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Dart\AppBundle\Entity\DeliveryAddress'
        ));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'DeliveryAddressType';
    }
}
