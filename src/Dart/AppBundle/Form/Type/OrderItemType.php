<?php

namespace Dart\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', new MealType(), array(
                'data_class' => 'Dart\AppBundle\Entity\Meal',
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
