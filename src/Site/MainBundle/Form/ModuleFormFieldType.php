<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Site\MainBundle\Entity\ModuleFormField as Field;

class ModuleFormFieldType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', 'choice', array(
                'required' => true,
                'label' => 'backend.module_form_field.type',
                'choices' => array(
                    Field::TYPE_TEXT => 'Текстовая строка',
                    Field::TYPE_EMAIL => 'Email',
                    Field::TYPE_SUBMIT => 'Кнопка отправки'
                )
            ))
            ->add('enableLabel', 'choice', array(
                'required' => true,
                'label' => 'backend.module_form_field.enableLabel',
                'choices' => array(
                    0 => 'Нет',
                    1 => 'Да'
                )
            ))
            ->add('enablePlaceholder', 'choice', array(
                'required' => true,
                'label' => 'backend.module_form_field.enablePlaceholder',
                'choices' => array(
                    0 => 'Нет',
                    1 => 'Да'
                )
            ))
            ->add('enableRequire', 'choice', array(
                'required' => true,
                'label' => 'backend.module_form_field.enableRequire',
                'choices' => array(
                    0 => 'Нет',
                    1 => 'Да'
                )
            ))
            ->add('title', 'text', array(
                'required' => true,
                'label' => 'backend.module_form_field.title'
            ))
            ->add('placeholder', 'text', array(
                'required' => true,
                'label' => 'backend.module_form_field.placeholder'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\ModuleFormField',
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
