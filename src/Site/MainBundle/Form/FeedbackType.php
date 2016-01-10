<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FeedbackType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'required' => true,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'frontend.feedback.placeholder.name',
                    'data-validation-required-message' => 'Пожалуйста введите ваше имя.'
                )
            ))
            ->add('phone', 'text', array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'frontend.feedback.placeholder.phone',
                    'data-validation-required-message' => 'Пожалуйста введите ваш номер телефона.'
                )
            ))
            ->add('email', 'email', array(
                'required' => true,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'frontend.feedback.placeholder.email',
                    'data-validation-required-message' => 'Пожалуйста введите ваш email адрес.'
                )
            ))
            ->add('theme', 'text', array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'frontend.feedback.placeholder.theme',
                    'data-validation-required-message' => 'Пожалуйста введите тему письма.'
                )
            ))
            ->add('message', 'text', array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'frontend.feedback.placeholder.message',
                    'data-validation-required-message' => 'Пожалуйста введите ваше сообщение.'
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
            'data_class' => 'Site\MainBundle\Form\Feedback',
            'translation_domain' => 'menu',
            'csrf_protection'   => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'site_mainbundle_feedback';
    }
}
