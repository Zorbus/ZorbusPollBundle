<?php

namespace Zorbus\PollBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Min;

class OptionAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->add('poll', null, array(
                    'required' => true,
                    'attr' => array('class' => 'span5 select2'),
                    'constraints' => array(
                        new NotBlank(),
                        new Type(array('type' => 'Zorbus\PollBundle\Entity\Poll'))
                    )
                ))
                ->add('answer', 'textarea', array(
                    'required' => false,
                    'attr' => array('class' => 'ckeditor'),
                    'constraints' => array(
                        new NotBlank()
                    )
                ))
                ->add('imageTemp', 'file', array(
                    'required' => false,
                    'label' => 'Image',
                    'constraints' => array(
                        new Image()
                    )
                ))
                ->add('position', null, array(
                        'required' => false,
                        'constraints' => array(
                            new Min(array('limit' => 0))
                        )
                    ))
                ->add('enabled', null, array('required' => false))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
                ->add('poll')
                ->add('answer')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
                ->addIdentifier('poll')
                ->addIdentifier('answer', 'text', array('safe' => true))
                ->add('enabled')
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