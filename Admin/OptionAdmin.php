<?php

namespace Zorbus\PollBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class OptionAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('poll', null, array('required' => true, 'attr' => array('class' => 'span5 select2')))
                ->add('option', 'textarea', array('required' => false, 'attr' => array('class' => 'ckeditor')))
                ->add('imageTemp', 'file', array('required' => false, 'label' => 'Image'))
                ->add('position')
                ->add('enabled', null, array('required' => false))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
                ->add('poll')
                ->add('option')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('poll')
                ->addIdentifier('option')
                ->add('enabled')
        ;
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
                ->with('poll')
                ->assertNotBlank()
                ->end()
                ->with('option')
                ->assertNotBlank()
                ->end()
        ;
    }

    public function prePersist($object)
    {
        $object->setUpdatedAt(new \DateTime());
    }

    public function preUpdate($object)
    {
        $object->setUpdatedAt(new \DateTime());
    }

}