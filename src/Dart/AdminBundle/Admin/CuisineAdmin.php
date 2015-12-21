<?php

namespace Dart\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Dart\AppBundle\Entity\Cuisine;

/**
 * Cuisine admin class
 * 
 * @package Dart\AppBundle
 * @subpackage Admin
 * @author Valerii Ten <eternitywisher@gmail.com>
 */
class CuisineAdmin extends Admin
{
    /**
     * {@inheritDoc}
     */
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper->add('name', 'text');
    }
    
    /**
     * {@inheritDoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper->add('name');
    }
    
    /**
     * {@inheritDoc}
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper->addIdentifier('name');
    }
    
    /**
     * {@inheritDoc}
     */
    public function toString($object)
    {
        return $object instanceof Cuisine ? $object->getName() : 'Cuisine';
    }
}
