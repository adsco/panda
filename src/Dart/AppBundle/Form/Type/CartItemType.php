<?php

namespace Dart\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Dart\AppBundle\Form\Type\MealType;

/**
 * Description of CartItemType
 *
 * @package 
 * @subpackage
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class CartItemType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', new MealType(), array(
                'disabled' => true
            ))
            ->add('count', new IntegerType(), array(
                'label' => 'Quantity'
            ))
        ;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dart\AppBundle\Component\CartItemBase'
        ));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'cart_item_form_type';
    }
}
