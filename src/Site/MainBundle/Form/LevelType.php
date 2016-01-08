<?php

namespace Site\MainBundle\Form;

use Site\MainBundle\Entity\ModuleHeader;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LevelType extends AbstractType
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
                'label' => 'backend.level.title'
            ))
            ->add('position', 'integer', array(
                'required' => true,
                'label' => 'backend.level.position',
                'attr' => array(
                    'min' => 0
                )
            ))
            ->add('moduleHeader', new ModuleHeaderType(), array(
                'required' => true,
                'label' => 'backend.level.moduleHeader'
            ))
            ->add('moduleLine', new ModuleLineType(), array(
                'required' => true,
                'label' => 'backend.level.moduleLine'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\Level',
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
