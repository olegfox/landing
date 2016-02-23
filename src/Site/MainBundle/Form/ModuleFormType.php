<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModuleFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array(
                'required' => false,
                'label' => 'backend.module_form.title'
            ))
            ->add('height', 'text', array(
                'required' => false,
                'label' => 'backend.module_form.height'
            ))
            ->add('width', 'text', array(
                'required' => true,
                'label' => 'backend.module_form.width'
            ))
            ->add('mailerHost', 'text', array(
                'required' => true,
                'label' => 'backend.module_form.mailerHost'
            ))
            ->add('mailerUser', 'text', array(
                'required' => true,
                'label' => 'backend.module_form.mailerUser'
            ))
            ->add('mailerPassword', 'text', array(
                'required' => true,
                'label' => 'backend.module_form.mailerPassword'
            ))
            ->add('emailTo', 'text', array(
                'required' => true,
                'label' => 'backend.module_form.emailTo'
            ))
            ->add('themeLetter', 'text', array(
                'required' => true,
                'label' => 'backend.module_form.themeLetter'
            ))
            ->add('emailFrom', 'text', array(
                'required' => true,
                'label' => 'backend.module_form.emailFrom'
            ))
            ->add('emailFromTitle', 'text', array(
                'required' => true,
                'label' => 'backend.module_form.emailFromTitle'
            ))
            ->add('file', 'file', array(
                'required' => true,
                'label' => 'backend.module_form.file'
            ))
            ->add('backgroundImg', 'text', array(
                'required' => true,
                'label' => 'backend.module_form.backgroundImg'
            ))
            ->add('backgroundColor', 'text', array(
                'required' => true,
                'label' => 'backend.module_form.backgroundColor'
            ))
            ->add('backgroundPosition', 'text', array(
                'required' => true,
                'label' => 'backend.module_form.backgroundPosition'
            ))
            ->add('backgroundAttachment', 'text', array(
                'required' => true,
                'label' => 'backend.module_form.backgroundAttachment'
            ))
            ->add('backgroundSize', 'text', array(
                'required' => true,
                'label' => 'backend.module_form.backgroundSize'
            ))
            ->add('shadow', 'text', array(
                'required' => false,
                'label' => 'backend.module_form.shadow'
            ))
            ->add('blur', 'text', array(
                'required' => false,
                'label' => 'backend.module_form.blur'
            ))
            ->add('fields', 'bootstrap_collection', array(
                'label'=>'backend.module_form.fields',
                'type' => new ModuleFormFieldType(),
                'allow_add'          => true,
                'allow_delete'       => true,
                'add_button_text'    => 'backend.module_form_field.add',
                'delete_button_text' => 'backend.module_form_field.delete',
                'sub_widget_col'     => 12,
                'button_col'         => 3
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Site\MainBundle\Entity\ModuleForm',
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
