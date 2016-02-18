<?php

namespace Site\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LevelType extends AbstractType
{
    private $type;

    public function __construct($type){
        $this->type = $type;
    }

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
            ));

        switch($this->type){
            case 'header': {
                $builder
                    ->add('moduleHeader', new ModuleHeaderType(), array(
                        'required' => true,
                        'label' => 'backend.level.moduleHeader'
                    ));
            }break;
            case 'line': {
                $builder
                    ->add('moduleLine', new ModuleLineType(), array(
                        'required' => true,
                        'label' => 'backend.level.moduleLine'
                    ));
            }break;
            case 'square': {
                $builder
                    ->add('moduleSquare', new ModuleSquareType(), array(
                        'required' => true,
                        'label' => 'backend.level.moduleSquare'
                    ));
            }break;
            case 'map': {
                $builder
                    ->add('moduleMap', new ModuleMapType(), array(
                        'required' => true,
                        'label' => 'backend.level.moduleMap'
                    ));
            }break;
            case 'comment': {
                $builder
                    ->add('moduleComment', new ModuleCommentType(), array(
                        'required' => true,
                        'label' => 'backend.level.moduleComment'
                    ));
            }break;
            default: {
                $builder
                    ->add('moduleHeader', new ModuleHeaderType(), array(
                        'required' => true,
                        'label' => 'backend.level.moduleHeader'
                    ));
            }break;
        }
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
