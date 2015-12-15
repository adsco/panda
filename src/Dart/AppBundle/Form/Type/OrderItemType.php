<?php

namespace Dart\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Dart\AppBundle\Form\Type\MealType;

/**
 * Order item form type
 *
 * @package \Dart\AppBundle
 * @subpackage Form\Type
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class OrderItemType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', new MealType(), array())
            ->add('count', new IntegerType(), array(
                'label' => 'Quantity'
            ))
        ;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dart\AppBundle\Entity\OrderItem'
        ));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'order_item';
    }
}
