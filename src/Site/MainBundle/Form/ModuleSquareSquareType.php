<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModuleSquareSquareType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'textarea', array(
                'required' => true,
                'label' => 'backend.module_square_square.title',
                "attr" => array(
                    "class" => "ckeditor"
                )
            ))
            ->add('blur', 'text', array(
                'required' => true,
                'label' => 'backend.module_square_square.blur'
            ))
            ->add('shadow', 'text', array(
                'required' => true,
                'label' => 'backend.module_square_square.shadow'
            ))
            ->add('backgroundColor', 'text', array(
                'required' => true,
                'label' => 'backend.module_square_square.backgroundColor'
            ))
            ->add('backgroundImg', 'text', array(
                'required' => true,
                'label' => 'backend.module_square_square.backgroundImg'
            ))
            ->add('file', 'file', array(
                'required' => true,
                'label' => 'backend.module_square_square.file'
            ))
            ->add('backgroundPosition', 'text', array(
                'required' => true,
                'label' => 'backend.module_square_square.backgroundPosition'
            ))
            ->add('backgroundAttachment', 'text', array(
                'required' => true,
                'label' => 'backend.module_square_square.backgroundAttachment'
            ))
            ->add('backgroundSize', 'text', array(
                'required' => true,
                'label' => 'backend.module_square_square.backgroundSize'
            ))
            ->add('icon', 'text', array(
                'required' => true,
                'label' => 'backend.module_square_square.icon'
            ))
            ->add('fileIcon', 'file', array(
                'required' => true,
                'label' => 'backend.module_square_square.fileIcon'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\ModuleSquareSquare',
            'translation_domain' => 'menu',
            'csrf_protection'   => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }
}
