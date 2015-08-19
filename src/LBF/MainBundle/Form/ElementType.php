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
            ->add('nameEs', 'text', array('label' => 'Name Es'))
            ->add('descriptionEs', 'textarea', array('label' => 'Description Es'))
            ->add('nameFr', 'text', array('label' => 'Name Fr',
                                            'required' => false))
            ->add('descriptionFr', 'textarea', array('label' => 'Description Fr',
                                                    'required' => false))
            ->add('nameEn', 'text', array('label' => 'Name En',
                                            'required' => false))
            ->add('descriptionEn', 'textarea', array('label' => 'Description En',
                                                    'required' => false))
            ->add('price', 'text', array('label' => 'Prix'))
            ->add('quantity', 'text', array('label' => 'Quantité',
                                            'required' => false))
            ->add('unit', 'text', array('label' => 'Unité',
                                        'required' => false))
            ->add('weight', 'text', array('label' => 'Poids'))
            ->add('type', 'text', array('label' => 'Type'))
            ->add('category', 'choice', array('label' => 'Categorie',
                                                'choices' => array( 'Catégorie' => array(   '1' => 'PanVino', 
                                                                                            '2' => 'BufSalado',
                                                                                            '3' => 'Embutidos',
                                                                                            '4' => 'BufDulce',
                                                                                            '5' => 'Mermeladas'))))
            ->add('naturalProduct', 'choice', array('label' => 'Naturel ?',
                                                    'choices' => array( 'Element naturel ?' => array(   '1' => 'Oui', 
                                                                                                        '0' => 'Non'))))
            ->add('active', 'choice', array('label' => 'Active',
                                                'choices' => array( 'active' => 'Actif',
                                                                    'new' => 'Nouveauté', 
                                                                    'toCome' => 'A venir', 
                                                                    'soldOut' => 'Epuisé',
                                                                    'inactive' => 'Inactif')))
            ->add('file', 'file', array('label'=> 'file',
                                        'required' => false))
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
