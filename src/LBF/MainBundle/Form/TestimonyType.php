<?php

namespace LBF\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TestimonyType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', 'textarea', array('label' => 'Content'))
            ->add('author', 'text', array('label' => 'Author'))
            ->add('rate', 'choice', array('label' => 'Rate',
                    'choices' => array(   5 => ' ', 
                                        4 => ' ',
                                        3 => ' ',
                                        2 => ' ',
                                        1 => ' '),
                    'expanded' => true,
                    'multiple' => false
                    ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LBF\MainBundle\Entity\Testimony'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lbf_mainbundle_testimony';
    }
}
