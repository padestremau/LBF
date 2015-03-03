<?php

namespace LBF\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ElementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Name'))
            ->add('description', 'textarea', array('label' => 'Description'))
            ->add('price', 'text', array('label' => 'Price'))
            ->add('quantity', 'text', array('label' => 'Quantity'))
            ->add('unit', 'text', array('label' => 'Unit'))
            ->add('weight', 'text', array('label' => 'Weight'))
            ->add('type', 'text', array('label' => 'Type'))
            ->add('category', 'choice', array('label' => 'Category',
                                                'choices' => array( 'Catégorie' => array(   'Embutidos' => 'Embutidos', 
                                                                                            'Pates' => 'Pates',
                                                                                            'Jamones' => 'Jamones',
                                                                                            'Epicerie fine' => 'Epicerie fine',
                                                                                            'Traiteur' => 'Traiteur'))))
            ->add('family', 'choice', array('label' => 'Family',
                                                'choices' => array( 'Famille ? (Optionnel)' => array(   '' => 'Aucune', 
                                                                                                        'Jam' => 'Confiture', 
                                                                                                        'Biscuit' => 'Biscuits'))))
            ->add('naturalProduct', 'choice', array('label' => 'Naturel ?',
                                                    'choices' => array( 'Element naturel ?' => array(   '1' => 'Oui', 
                                                                                                        '0' => 'Non'))))
            ->add('active', 'choice', array('label' => 'Active',
                                                'choices' => array( 'active' => 'Actif',
                                                                    'toCome' => 'A venir', 
                                                                    'soldOut' => 'Epuisé',
                                                                    'inactive' => 'Inactif')))
            ->add('file', 'file')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LBF\MainBundle\Entity\Element'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lbf_mainbundle_element';
    }
}
