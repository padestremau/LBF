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
            ->add('ingredients', 'choice', array('label' => 'Ingredients'))
            ->add('preparation', 'choice', array('label' => 'Preparation'))
            ->add('description', 'textarea', array('label' => 'Description'))
            ->add('active', 'choice', array('label' => 'Active',
                                            'choices' => array( 'active' => 'Actif',
                                                                'toCome' => 'A venir', 
                                                                'soldOut' => 'Epuisé',
                                                                'inactive' => 'Inactif')))
            ->add('file', 'file')
            ->add('element', 'entity', array(   'class' => 'LBFMainBundle:Element',
                                                'property' => 'Name'
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
