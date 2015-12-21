<?php

namespace Dart\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Dart\AppBundle\Entity\Category;

/**
 * Cateogry admin class
 * 
 * @package Dart\AppBundle
 * @subpackage Admin
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class CategoryAdmin extends Admin
{
    /**
     * {@inheritDoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('cuisine', 'sonata_type_model', array(
                'class' => 'Dart\AppBundle\Entity\Cuisine',
                'property' => 'name',
                'label' => 'Cuisine'
            ))
            ->add('name', 'text', array(
                'label' => 'Name'
            ))
        ;
    }
    
    /**
     * {@inheritDoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('cuisine.name')
            ->add('name')
        ;
    }
    
    /**
     * {@inheritDoc}
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('cuisine.name')
            ->addIdentifier('name')
        ;
    }
    
    /**
     * 
     * @param Category $object
     * @return type{@inheritDoc}
     */
    public function toString($object)
    {
        return $object instanceof Category ? $object->getName() : 'Category';
    }
}
