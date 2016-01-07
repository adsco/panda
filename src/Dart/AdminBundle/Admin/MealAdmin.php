<?php

namespace Dart\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Dart\AppBundle\Entity\Meal;
use \Doctrine\ORM\EntityRepository;

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
    protected function configureFormFields(FormMapper $formMapper)
    {
        $categories = $this->transformCuisine($this->getCuisines());
        $meal = $this->getSubject();
        $fileOptions = array(
            'label' => 'Image'
        );
        
        if ($meal->getImage()) {
            $fileOptions['required'] = false;
            $formMapper->add('current_image', 'text', array(
                'label' => 'Current image',
                'mapped' => false,
                'disabled' => true,
                'data' => $meal->getImage()
            ));
        } else {
            $fileOptions['required'] = true;
        }
        
        $formMapper
            ->add('file', 'file', $fileOptions)
            ->add('category_id', 'choice', array(
                'choices' => $categories,
                'label' => 'Category'
            ))
            ->add('name', 'text', array(
                'label' => 'Meal name'
            ))
            ->add('description', 'textarea', array(
                'label' => 'Meal description'
            ))
            ->add('featured', 'checkbox', array(
                'label' => 'Show on main page'
            ))
        ;
        
        $formMapper
            ->add('price', 'integer', array(
                'label' => 'Meal price'
            ))
            ->add('weight', 'integer', array(
                'label' => 'Meal weight'
            ))
        ;
    }
    
    public function prePersist($object)
    {
        $em = $this->modelManager->getEntityManager('Dart\AppBundle\Entity\Category');
        $category = $em->getRepository('AppBundle:Category')->findOneBy(array('id' => $object->getCategoryId()));
        if (!$category) {
            throw new \Exception($object->getCategoryId());
        }
        
        $object->setCategory($category);
    }
    
    private function getCuisines()
    {
        $em = $this->modelManager->getEntityManager('Dart\AppBundle\Entity\Cuisine');
        $qb = $em
            ->createQueryBuilder('c')
            ->select('c,cc')
            ->from('AppBundle:Cuisine', 'c')
            ->leftJoin('c.categories', 'cc')
            ->getQuery();
        
        return $qb->getArrayResult();
    }
    
    private function transformCuisine($cuisines)
    {
        $result = array();
        
        foreach ($cuisines as $cuisine) {
            if (!key_exists($cuisine['name'], $result)) {
                $result[$cuisine['name']] = array();
            }
            
            foreach ($cuisine['categories'] as $category) {
                $result[$cuisine['name']][$category['id']] = $category['name'];
            }
        }
        
        return $result;
    }
    
    /**
     * {@inheritDoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
        $datagridMapper->add('price');
        $datagridMapper->add('weight');
    }
    
    /**
     * {@inheritDoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
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
