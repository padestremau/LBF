<?php

namespace LBF\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdminUserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'text', array('label' => 'email'))
            ->add('firstName', 'text', array('label' => 'firstName'))
            ->add('lastName', 'text', array('label' => 'lastName'))
            ->add('tel', 'text', array('label' => 'tel'))
            ->add('age', 'text', array('label' => 'age'))
            ->add('addressNumber', 'text', array('label' => 'addressNumber'))
            ->add('addressStreet', 'text', array('label' => 'addressStreet'))
            ->add('addressPostCode', 'text', array('label' => 'addressPostCode'))
            ->add('addressCity', 'text', array('label' => 'addressCity'))
            ->add('addressCountry', 'text', array('label' => 'addressCountry'))
            ->add('gender', 'text', array('label' => 'gender'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LBF\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lbf_userbundle_adminuser';
    }
}
