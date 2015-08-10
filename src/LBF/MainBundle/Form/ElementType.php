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
            ->add('nameFr', 'text', array('label' => 'Name Fr'))
            ->add('descriptionFr', 'textarea', array('label' => 'Description Fr'))
            ->add('nameEs', 'text', array('label' => 'Name Es'))
            ->add('descriptionEs', 'textarea', array('label' => 'Description Es'))
            ->add('nameEn', 'text', array('label' => 'Name En'))
            ->add('descriptionEn', 'textarea', array('label' => 'Description En'))
            ->add('price', 'text', array('label' => 'Prix'))
            ->add('quantity', 'text', array('label' => 'Quantité'))
            ->add('unit', 'text', array('label' => 'Unité'))
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
