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
            ->add('street', new TextType())
            ->add('building', new TextType())
            ->add('porch', new IntegerType())
            ->add('apartment', new TextType())
            ->add('intercome_code', new TextType())
            ->add('note', new TextareaType())
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
