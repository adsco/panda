<?php

namespace Dart\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Dart\AppBundle\Form\Type\UserProfileType;

/**
 * Customize default FOSUserBundle registration form
 *
 * @package \Dart\AppBundle
 * @subpackage Controller
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class RegistrationType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('username')
            ->remove('email')
            ->remove('plainPassword')
        ;
        
        $builder
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'messages'))
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'messages'))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'messages'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('profile', new UserProfileType(), array(
                'by_reference' => false
            ))
        ;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'fos_user_registration';
    }
    
    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'app_user_registration';
    }
}
