<?php

namespace Dart\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Dart\AppBundle\Form\Type\DeliveryAddressType;
use Dart\AppBundle\Form\Type\OrderUserProfileType;
use Dart\AppBundle\Entity\Order;
use Dart\AppBundle\Form\Type\OrderItemType;

/**
 * Admin order handler
 *
 * @package \Dart\AdminBundle
 * @subpackage Admin
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class OrderAdmin extends Admin
{
    /**
     * {@inheritDoc}
     */
    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('order_items', 'entity', array(
                'class' => 'AppBundle:Meal',
                'property' => 'name',
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('m')
                        ->orderBy('m.name');
                }
            ))
            ->add('delivery_price', new IntegerType())
            ->add('change', new IntegerType())
            ->add('delivery_address', new DeliveryAddressType())
            ->add('order_user_profile', new OrderUserProfileType())
            ->add('status', new ChoiceType(), array(
                'choices' => array(
                    Order::$STATUS_NEW,
                    Order::$STATUS_ACCEPTED,
                    Order::$STATUS_READY,
                    Order::$STATUS_COMPLETE
                )
            ))
        ;
    }
    
    /**
     * {@inheritDoc}
     */
    public function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('status')
            ->add('creation_date')
        ;
    }
    
    /**
     * {@inheritDoc}
     */
    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('price')
            ->addIdentifier('delivery_price')
            ->addIdentifier('change')
            ->addIdentifier('status')
            ->addIdentifier('creation_date')
        ;
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString($object)
    {
        return $object instanceof Order ? $object->getId() : 'Order';
    }
}
