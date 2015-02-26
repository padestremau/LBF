<?php

namespace LBF\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('firstName')
            ->add('lastName')
            ->add('companyName')
            ->add('tel')
            ->add('age')
            ->add('addressNumber')
            ->add('addressStreet')
            ->add('addressPostCode')
            ->add('addressCity')
            ->add('addressCountry')
            ->add('RUCnumber')
            ->add('gender')
            ->add('url')
            ->add('alt')
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
        return 'lbf_userbundle_user';
    }
}
