<?php

namespace Dart\AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Dart\AppBundle\Entity\Meal;

/**
 * Admin class for Meal entity
 * 
 * @package Dart\AppBundle
 * @subpackage Admin
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class MealAdmin extends Admin
{
    /**
     * {@inheritDoc}
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->tab('Basic data')
                ->with('Textual data')
                    ->add('name', 'text')
                    ->add('description', 'textarea')
                ->end()
            ->end();
        
        $formMapper
            ->tab('General data')
                ->with('Numerical data')
                    ->add('price', 'integer')
                    ->add('weight', 'integer')
                ->end()
            ->end();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper->add('name');
        $datagridMapper->add('price');
        $datagridMapper->add('weight');
    }
    
    /**
     * {@inheritDoc}
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('price');
        $listMapper->addIdentifier('weight');
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString($object)
    {
        return $object instanceof Meal ? $object->getName() : 'Meal';
    }
}
