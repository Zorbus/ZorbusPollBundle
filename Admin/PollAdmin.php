<?php

namespace Zorbus\PollBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\MaxLength;

class PollAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('title', null, array('constraints' => array(
                        new NotBlank(),
                        new MaxLength(array('limit' => 255))
                        )))
                ->add('question', 'textarea', array(
                    'required' => false,
                    'attr' => array('class' => 'ckeditor'),
                    'constraints' => array(
                        new NotBlank()
                        ))
                )
                ->add('lang', 'language', array(
                    'preferred_choices' => array('pt_PT', 'en')
                ))
                ->add('enabled', null, array('required' => false))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
                ->add('title')
                ->add('question')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('title')
                ->add('enabled')
        ;
    }

}