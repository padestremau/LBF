<?php

namespace LBF\MainBundle\Form;

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
            ->add('origin', 'text', array('label' => 'Origin'))
            ->add('ingredientsFr', 'redactor', array(
                "redactor"=>"admin_main",
                'label' => 'Ingredients Fr'))
            ->add('preparationFr', 'redactor', array(
                "redactor"=>"admin_main",
                'label' => 'Preparation Fr'))
            ->add('descriptionFr', 'redactor', array(
                "redactor"=>"admin_main",
                'label' => 'Description Fr'))
            ->add('ingredientsEs', 'redactor', array(
                "redactor"=>"admin_main",
                'label' => 'Ingredients Es'))
            ->add('preparationEs', 'redactor', array(
                "redactor"=>"admin_main",
                'label' => 'Preparation Es'))
            ->add('descriptionEs', 'redactor', array(
                "redactor"=>"admin_main",
                'label' => 'Description Es'))
            ->add('ingredientsEn', 'redactor', array(
                "redactor"=>"admin_main",
                'label' => 'Ingredients En'))
            ->add('preparationEn', 'redactor', array(
                "redactor"=>"admin_main",
                'label' => 'Preparation En'))
            ->add('descriptionEn', 'redactor', array(
                "redactor"=>"admin_main",
                'label' => 'Description En'))
            ->add('active', 'choice', array('label' => 'Active',
                                            'choices' => array( 'active' => 'Actif',
                                                                'new' => 'Nouveauté', 
                                                                'toCome' => 'A venir', 
                                                                'soldOut' => 'Epuisé',
                                                                'inactive' => 'Inactif')))
            ->add('file', 'file')
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
