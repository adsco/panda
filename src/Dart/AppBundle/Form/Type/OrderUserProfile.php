<?php

namespace Dart\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

/**
 * OrderUserProfile form type
 *
 * @package \Dart\AppBundle
 * @subpackage Form\Type
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class OrderUserProfile extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', new TextType(), array(
                'label' => 'Name'
            ))
            ->add('phone', new TextType(), array(
                'label' => 'Phone'
            ))
        ;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dart\AppBundle\Entity\OrderUserProfile'
        ));
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'order_user_profile_form_type';
    }
}
