<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModuleHeaderType extends AbstractType
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
                'label' => 'backend.module_header.enable',
                'choices' => array(
                    false => 'Нет',
                    true => 'Да',
                )
            ))
            ->add('backgroundImg', 'text', array(
                'required' => true,
                'label' => 'backend.module_header.backgroundImg'
            ))
            ->add('file', 'file', array(
                'required' => true,
                'label' => 'backend.module_header.file'
            ))
            ->add('video', 'text', array(
                'required' => true,
                'label' => 'backend.module_header.video'
            ))
            ->add('fileVideo', 'file', array(
                'required' => true,
                'label' => 'backend.module_header.fileVideo'
            ))
            ->add('backgroundPosition', 'text', array(
                'required' => true,
                'label' => 'backend.module_header.backgroundPosition'
            ))
            ->add('backgroundAttachment', 'choice', array(
                'required' => true,
                'label' => 'backend.module_header.backgroundAttachment',
                'choices' => array(
                    'scroll' => 'нефиксированный',
                    'fixed' => 'фиксированный'
                )
            ))
            ->add('backgroundSize', 'text', array(
                'required' => true,
                'label' => 'backend.module_header.backgroundSize'
            ))
            ->add('shadow', 'text', array(
                'required' => true,
                'label' => 'backend.module_header.shadow'
            ))
            ->add('head1', 'text', array(
                'required' => true,
                'label' => 'backend.module_header.head1'
            ))
            ->add('head2', 'text', array(
                'required' => true,
                'label' => 'backend.module_header.head2'
            ))
            ->add('isButton', 'choice', array(
                'required' => true,
                'label' => 'backend.module_header.isButton',
                'choices' => array(
                    false => 'Нет',
                    true => 'Да',
                )
            ))
            ->add('textButton', 'text', array(
                'required' => true,
                'label' => 'backend.module_header.textButton'
            ))
            ->add('hintLeft', 'text', array(
                'required' => true,
                'label' => 'backend.module_header.hintLeft'
            ))
            ->add('hintRight1', 'text', array(
                'required' => true,
                'label' => 'backend.module_header.hintRight1'
            ))
            ->add('hintRight2', 'text', array(
                'required' => true,
                'label' => 'backend.module_header.hintRight2'
            ))
            ->add('isArrow', 'choice', array(
                'required' => true,
                'label' => 'backend.module_header.isArrow',
                'choices' => array(
                    false => 'Нет',
                    true => 'Да',
                )
            ))
            ->add('isArrowFlashing', 'choice', array(
                'required' => true,
                'label' => 'backend.module_header.isArrowFlashing',
                'choices' => array(
                    false => 'Нет',
                    true => 'Да',
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
            'data_class' => 'Site\MainBundle\Entity\ModuleHeader',
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
