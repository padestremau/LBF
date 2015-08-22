<?php

namespace LBF\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MemberType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Name'))
            ->add('descriptionEs', 'textarea', array('label' => 'Description Es'))
            ->add('descriptionFr', 'textarea', array('label' => 'Description Fr',
                                                    'required' => false))
            ->add('descriptionEn', 'textarea', array('label' => 'Description En',
                                                    'required' => false))
            ->add('orderList', 'text', array('label' => 'Order'))
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
            'data_class' => 'LBF\MainBundle\Entity\Member'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lbf_mainbundle_member';
    }
}
