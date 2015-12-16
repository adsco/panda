<?php

namespace Dart\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;
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
                'label' => 'Quantity',
                'constraints' => array(
                    new NotBlank(),
                    new Range(array(
                        'min' => 1
                    ))
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
