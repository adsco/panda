<?php

namespace Dart\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of UserProfileType
 *
 * @author 1
 */
class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', new TextType(), array(
                'label' => 'Name',
                'required' => false
            ))
            ->add('phone', new TextType(), array(
                'label' => 'Phone',
                'required' => false
            ))
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dart\AppBundle\Entity\UserProfile'
        ));
    }

    public function getName()
    {
        return 'UserProfile';
    }
}
