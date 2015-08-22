<?php

namespace LBF\MainBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label' => 'Title'))
            ->add('dataBaseName', 'text', array('label' => 'Database name'))
            ->add('headerEs', 'text', array('label' => 'Header Es'))
            ->add('headerFr', 'text', array('label' => 'Header Fr',
                                                    'required' => false))
            ->add('headerEn', 'text', array('label' => 'Header En',
                                                    'required' => false))
            ->add('descriptionEs', 'textarea', array('label' => 'Description Es',
                                                    'required' => false))
            ->add('descriptionFr', 'textarea', array('label' => 'Description Fr',
                                                    'required' => false))
            ->add('descriptionEn', 'textarea', array('label' => 'Description En',
                                                    'required' => false))
            ->add('contentEs', 'redactor', array('label' => 'Content Es',
                                                    'redactor' => "admin_page",
                                                    'required' => false))
            ->add('contentFr', 'redactor', array('label' => 'Content Fr',
                                                    'redactor' => "admin_page",
                                                    'required' => false))
            ->add('contentEn', 'redactor', array('label' => 'Content En',
                                                    'redactor' => "admin_page",
                                                    'required' => false))
            ->add('type', 'choice', array(
                'label' => 'type',
                'choices' => array(
                                    'lhdc' => 'Logo, Titre, Description, Contenu',
                                    'lhd' => 'Logo, Titre, Description',
                                    'hdc' => 'Titre, Description, Contenu',
                                    'hd' => 'Titre, Description',
                                    'hc' => 'Titre, Contenu'
                    )
                ))
            ->add('file','file', array('label' => 'File',
                                    'required' => false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LBF\MainBundle\Entity\Page'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lbf_mainbundle_page';
    }
}
