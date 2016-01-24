<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StyleHeadType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array(
                'required' => true,
                'label' => 'backend.style_head.title'
            ))
            ->add('link', 'text', array(
                'required' => true,
                'label' => 'backend.style_head.link'
            ))
            ->add('size', 'text', array(
                'required' => true,
                'label' => 'backend.style_head.size'
            ))
            ->add('color', 'text', array(
                'required' => true,
                'label' => 'backend.style_head.color',
                'attr' => array(
                    'class' => 'colorSelector'
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
            'data_class' => 'Site\MainBundle\Entity\StyleHead',
            'translation_domain' => 'menu'
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
