<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModuleMapType extends AbstractType
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
                'label' => 'backend.module_map.enable',
                'choices' => array(
                    false => 'Нет',
                    true => 'Да',
                )
            ))
            ->add('height', 'text', array(
                'required' => true,
                'label' => 'backend.module_map.height'
            ))
            ->add('code', 'textarea', array(
                'required' => true,
                'label' => 'backend.module_map.code'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\ModuleMap',
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
