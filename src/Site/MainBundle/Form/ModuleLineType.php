<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModuleLineType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('enable', 'choice', array(
                'required' => true,
                'label' => 'backend.module_line.enable',
                'choices' => array(
                    false => 'Нет',
                    true => 'Да',
                )
            ))
            ->add('height', 'text', array(
                'required' => true,
                'label' => 'backend.module_line.height'
            ))
            ->add('width', 'text', array(
                'required' => true,
                'label' => 'backend.module_line.width'
            ))
            ->add('backgroundColor', 'text', array(
                'required' => true,
                'label' => 'backend.module_line.backgroundColor'
            ))
            ->add('backgroundImg', 'text', array(
                'required' => true,
                'label' => 'backend.module_line.backgroundImg'
            ))
            ->add('file', 'file', array(
                'required' => true,
                'label' => 'backend.module_line.file'
            ))
            ->add('backgroundPosition', 'text', array(
                'required' => true,
                'label' => 'backend.module_line.backgroundPosition'
            ))
            ->add('backgroundAttachment', 'choice', array(
                'required' => true,
                'label' => 'backend.module_line.backgroundAttachment',
                'choices' => array(
                    'scroll' => 'нефиксированный',
                    'fixed' => 'фиксированный'
                )
            ))
            ->add('backgroundSize', 'text', array(
                'required' => true,
                'label' => 'backend.module_line.backgroundSize'
            ))
            ->add('verticalAlign', 'choice', array(
                'required' => true,
                'label' => 'backend.module_line.verticalAlign',
                'choices' => array(
                    'top' => 'сверху',
                    'middle' => 'по центру',
                    'bottom' => 'снизу',
                )
            ))
            ->add('text', 'textarea', array(
                'required' => true,
                'label' => 'backend.module_line.text',
                "attr" => array(
                    "class" => "ckeditor"
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\ModuleLine',
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
