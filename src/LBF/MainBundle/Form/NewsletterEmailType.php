<?php

namespace LBF\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsletterEmailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'text', array('label' => 'Email'))
            ->add('category', 'choice', array(
                'choices' => array(
                    'user' => 'Particulier',
                    'company' => 'Entreprise'
                    ),
                'label' => 'Categorie'
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LBF\MainBundle\Entity\NewsletterEmail'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lbf_mainbundle_newsletteremail';
    }
}
