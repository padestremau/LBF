<?php

namespace LBF\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class HomePhotoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('photoOrder', 'text', array('label' => 'Order'))
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
            'data_class' => 'LBF\MainBundle\Entity\HomePhoto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lbf_mainbundle_homephoto';
    }
}
