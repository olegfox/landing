<?php

namespace Site\MainBundle\Form;

use Site\MainBundle\Entity\ModuleCommentComments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModuleCommentType extends AbstractType
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
                'label' => 'backend.module_comment.title',
                "attr" => array(
                    "class" => "ckeditor"
                )
            ))
            ->add('time', 'number', array(
                'required' => true,
                'label' => 'backend.module_comment.time'
            ))
            ->add('lineHeight', 'text', array(
                'required' => true,
                'label' => 'backend.module_comment.lineHeight'
            ))
            ->add('backgroundLine', 'text', array(
                'required' => true,
                'label' => 'backend.module_comment.backgroundLine'
            ))
            ->add('height', 'text', array(
                'required' => true,
                'label' => 'backend.module_comment.height'
            ))
            ->add('width', 'text', array(
                'required' => true,
                'label' => 'backend.module_comment.width'
            ))
            ->add('shadow', 'text', array(
                'required' => true,
                'label' => 'backend.module_comment.shadow'
            ))
            ->add('shadowText', 'text', array(
                'required' => true,
                'label' => 'backend.module_comment.shadowText'
            ))
            ->add('backgroundColor', 'text', array(
                'required' => true,
                'label' => 'backend.module_comment.backgroundColor',
                'attr' => array(
                    'class' => 'colorSelector'
                )
            ))
            ->add('backgroundImg', 'text', array(
                'required' => true,
                'label' => 'backend.module_comment.backgroundImg'
            ))
            ->add('file', 'file', array(
                'required' => true,
                'label' => 'backend.module_comment.file'
            ))
            ->add('backgroundPosition', 'text', array(
                'required' => true,
                'label' => 'backend.module_comment.backgroundPosition'
            ))
            ->add('backgroundAttachment', 'choice', array(
                'required' => true,
                'label' => 'backend.module_comment.backgroundAttachment',
                'choices' => array(
                    'scroll' => 'нефиксированный',
                    'fixed' => 'фиксированный'
                )
            ))
            ->add('backgroundSize', 'text', array(
                'required' => true,
                'label' => 'backend.module_comment.backgroundSize'
            ))
            ->add('comments', 'bootstrap_collection', array(
                'label'=>'backend.module_comment.comments',
                'type' => new ModuleCommentCommentsType(),
                'allow_add'          => true,
                'allow_delete'       => true,
                'add_button_text'    => 'backend.module_comment_comments.add',
                'delete_button_text' => 'backend.module_comment_comments.delete',
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
            'data_class' => 'Site\MainBundle\Entity\ModuleComment',
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
