<?php

namespace Dart\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * User address form
 *
 * @package \Dart\AppBundle
 * @subpackage Form\Type
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class UserAddressType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('title', new TextType(), array(
                'label' => 'Title'
            ))
            ->add('street', new TextType(), array(
                'label' => 'Street'
            ))
            ->add('building', new TextType(), array(
                'label' => 'Building number',
                'required' => false
            ))
            ->add('porch', new IntegerType(), array(
                'label' => 'Porch number',
                'required' => false
            ))
            ->add('apartment', new TextType(), array(
                'label' => 'Apartment number',
                'required' => false
            ))
            ->add('intercome_code', new TextType(), array(
                'label' => 'Intercome code',
                'required' => false
            ))
            ->add('note', new TextareaType(), array(
                'label' => 'Note',
                'required' => false
            ))
        ;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Dart\AppBundle\Entity\UserAddress'
        ));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'user_address_type';
    }
}
