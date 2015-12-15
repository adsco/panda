<?php

namespace Dart\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

/**
 * Meal form
 *
 * @package \Dart\AppBundle
 * @subpackage Form\Type
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class MealType extends AbstractType
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options) {
        $builder
            ->add('name', new TextType(), array(
                'label' => 'Name'
            ))
            ->add('price', new IntegerType(), array(
                'label' => 'Price'
            ))
            ->add('image', new TextType(), array(
                'label' => 'Image'
            ))
        ;
    }
    
    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Dart\AppBundle\Entity\Meal'
        ));
    }
    
    public function getName()
    {
        return 'meal';
    }
}
