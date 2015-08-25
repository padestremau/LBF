<?php

namespace LBF\MainBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecipeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label' => 'Title'))
            ->add('duration', 'text', array('label' => 'Duration'))
            ->add('forHowMany', 'text', array('label' => 'For how many'))
            ->add('cooking', 'text', array('label' => 'Cooking'))
            ->add('origin', 'text', array('label' => 'Origin',
                'required' => false))
            
            ->add('ingredientsFr', 'collection', array(
                'type' => 'text',
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'prototype_name' => 'ingredientsFr__name__',
                'by_reference' => false,
                'error_bubbling' => false
            ))
            ->add('preparationFr', 'collection', array(
                'type' => 'textarea',
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'prototype_name' => 'preparationFr__name__',
                'by_reference' => false,
                'error_bubbling' => false
            ))
            ->add('descriptionFr', 'textarea', array(
                'required' => false))

            ->add('ingredientsEs', 'collection', array(
                'type' => 'text',
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'prototype_name' => 'ingredientsEs__name__',
                'by_reference' => false,
                'error_bubbling' => false
            ))
            ->add('preparationEs', 'collection', array(
                'type' => 'textarea',
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'prototype_name' => 'preparationEs__name__',
                'by_reference' => false,
                'error_bubbling' => false
            ))
            ->add('descriptionEs', 'textarea')
            
            ->add('ingredientsEn', 'collection', array(
                'type' => 'text',
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'prototype_name' => 'ingredientsEn__name__',
                'by_reference' => false,
                'error_bubbling' => false
            ))
            ->add('preparationEn', 'collection', array(
                'type' => 'textarea',
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'prototype_name' => 'preparationEn__name__',
                'by_reference' => false,
                'error_bubbling' => false
            ))
            ->add('descriptionEn', 'textarea', array(
                'required' => false))
            
            ->add('active', 'choice', array('label' => 'Active',
                                            'choices' => array( 'active' => 'Active',
                                                                'new' => 'Nouveauté', 
                                                                'inactive' => 'Inactive')))
            ->add('taste', 'choice', array('label' => 'Taste',
                                            'choices' => array( 1 => 'Salée',
                                                                0 => 'Sucrée')))
            ->add('file', 'file', array('label' => 'file',
                                        'required' => false))
            ->add('element', 'entity', array(   'class' => 'LBFMainBundle:Element',
                                                'property' => 'NameEs'
                                                // 'multiple' => true
                                            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LBF\MainBundle\Entity\Recipe'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lbf_mainbundle_recipe';
    }
}
