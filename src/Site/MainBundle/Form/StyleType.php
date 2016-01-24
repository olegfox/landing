<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StyleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('font', 'text', array(
                'required' => true,
                'label' => 'backend.style.font'
            ))
            ->add('cssFont', 'text', array(
                'required' => true,
                'label' => 'backend.style.cssFont'
            ))
            ->add('fontColor', 'text', array(
                'required' => true,
                'label' => 'backend.style.fontColor',
                'attr' => array(
                    'class' => 'colorSelector'
                )
            ))
            ->add('backgroundImg', 'text', array(
                'required' => true,
                'label' => 'backend.style.backgroundImg'
            ))
            ->add('file', 'file', array(
                'required' => true,
                'label' => 'backend.style.file'
            ))
            ->add('favicon', 'text', array(
                'required' => true,
                'label' => 'backend.style.favicon'
            ))
            ->add('fileFavicon', 'file', array(
                'required' => true,
                'label' => 'backend.style.fileFavicon'
            ))
            ->add('backgroundPosition', 'text', array(
                'required' => true,
                'label' => 'backend.style.backgroundPosition'
            ))
            ->add('backgroundAttachment', 'choice', array(
                'required' => true,
                'label' => 'backend.style.backgroundAttachment',
                'choices' => array(
                    'scroll' => 'нефиксированный',
                    'fixed' => 'фиксированный'
                )
            ))
            ->add('backgroundSize', 'text', array(
                'required' => true,
                'label' => 'backend.style.backgroundSize'
            ))
            ->add('metaTitle', 'text', array(
                'required' => true,
                'label' => 'backend.style.metaTitle'
            ))
            ->add('metaDescription', 'textarea', array(
                'required' => true,
                'label' => 'backend.style.metaDescription'
            ))
            ->add('metaKeywords', 'text', array(
                'required' => true,
                'label' => 'backend.style.metaKeywords'
            ))
            ->add('heads', 'bootstrap_collection', array(
                'label'=>'backend.style.heads',
                'type' => new StyleHeadType(),
                'allow_add'          => true,
                'allow_delete'       => true,
                'add_button_text'    => 'backend.style_head.add',
                'delete_button_text' => 'backend.style_head.delete',
                'sub_widget_col'     => 9,
                'button_col'         => 3,
                'prototype_name'     => 'inlinep',
                'options'            => array(
                    'attr' => array('style' => 'inline')
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
            'data_class' => 'Site\MainBundle\Entity\Style',
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
