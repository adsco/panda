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
                'label' => 'form.address.title'
            ))
            ->add('street', new TextType(), array(
                'label' => 'form.address.street'
            ))
            ->add('building', new TextType(), array(
                'label' => 'form.address.building',
                'required' => false
            ))
            ->add('porch', new IntegerType(), array(
                'label' => 'form.address.porch',
                'required' => false
            ))
            ->add('apartment', new IntegerType(), array(
                'label' => 'form.address.apartment',
                'required' => false
            ))
            ->add('intercome_code', new TextType(), array(
                'label' => 'form.address.intercome',
                'required' => false
            ))
            ->add('note', new TextareaType(), array(
                'label' => 'form.address.note',
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
