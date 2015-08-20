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
            ->add('ingredientsFr', 'textarea', array(
                'label' => 'Ingredients Fr',
                'required' => false))
            ->add('preparationFr', 'textarea', array(
                'label' => 'Preparation Fr',
                'required' => false))
            ->add('descriptionFr', 'textarea', array(
                'label' => 'Description Fr',
                'required' => false))
            ->add('ingredientsEs', 'redactor', array(
                'redactor' => 'admin_recipe',
                'label' => 'Ingredients Es'))
            ->add('preparationEs', 'textarea', array(
                'label' => 'Preparation Es'))
            ->add('descriptionEs', 'textarea', array(
                'label' => 'Description Es'))
            ->add('ingredientsEn', 'textarea', array(
                'label' => 'Ingredients En',
                'required' => false))
            ->add('preparationEn', 'textarea', array(
                'label' => 'Preparation En',
                'required' => false))
            ->add('descriptionEn', 'textarea', array(
                'label' => 'Description En',
                'required' => false))
            ->add('active', 'choice', array('label' => 'Active',
                                            'choices' => array( 'active' => 'Actif',
                                                                'new' => 'Nouveauté', 
                                                                'inactive' => 'Inactif')))
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
