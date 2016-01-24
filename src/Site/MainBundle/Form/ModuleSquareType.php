<?php

namespace Site\MainBundle\Form;

use Site\MainBundle\Entity\ModuleSquareSquare;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModuleSquareType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('enable', 'choice', array(
//                'required' => true,
//                'label' => 'backend.module_square.enable',
//                'choices' => array(
//                    false => 'Нет',
//                    true => 'Да',
//                )
//            ))
            ->add('countSquareInCol', 'integer', array(
                'required' => true,
                'label' => 'backend.module_square.countSquareInCol'
            ))
            ->add('height', 'text', array(
                'required' => true,
                'label' => 'backend.module_square.height'
            ))
            ->add('fontSize', 'text', array(
                'required' => true,
                'label' => 'backend.module_square.fontSize'
            ))
            ->add('blur', 'text', array(
                'required' => true,
                'label' => 'backend.module_square.blur'
            ))
            ->add('shadow', 'text', array(
                'required' => true,
                'label' => 'backend.module_square.shadow'
            ))
            ->add('backgroundColor', 'text', array(
                'required' => true,
                'label' => 'backend.module_square.backgroundColor',
                'attr' => array(
                    'class' => 'colorSelector'
                )
            ))
            ->add('backgroundImg', 'text', array(
                'required' => true,
                'label' => 'backend.module_square.backgroundImg'
            ))
            ->add('file', 'file', array(
                'required' => true,
                'label' => 'backend.module_square.file'
            ))
            ->add('backgroundPosition', 'text', array(
                'required' => true,
                'label' => 'backend.module_square.backgroundPosition'
            ))
            ->add('backgroundAttachment', 'choice', array(
                'required' => true,
                'label' => 'backend.module_square.backgroundAttachment',
                'choices' => array(
                    'scroll' => 'нефиксированный',
                    'fixed' => 'фиксированный'
                )
            ))
            ->add('backgroundSize', 'text', array(
                'required' => true,
                'label' => 'backend.module_square.backgroundSize'
            ))
            ->add('squares', 'bootstrap_collection', array(
                'label'=>'backend.module_square.squares',
                'type' => new ModuleSquareSquareType(),
                'allow_add'          => true,
                'allow_delete'       => true,
                'add_button_text'    => 'backend.module_square_square.add',
                'delete_button_text' => 'backend.module_square_square.delete',
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
            'data_class' => 'Site\MainBundle\Entity\ModuleSquare',
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
