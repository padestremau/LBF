<?php

namespace LBF\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdminConfirmOrdersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('elements', 'choice', array(
            //                                 'multiple'  => true
            //                             ))
            ->add('deliveryAt', 'datetime', array(
                                            'input'  => 'datetime',
                                            // 'format' => 'dd - MMMM - yyyy',
                                            'widget' => 'choice',
                                            'hours' => range(10,19,1),
                                            'minutes' => range(0,45,15),
                                            'years' => range(2015,2050,1)
                                            // 'placeholder' => array('year' => $year, 'month' => $month, 'day' => $day, 'minute' => $minutes, 'hour' => $hours)
                                        ))
            ->add('status', 'choice', array('label' => 'Status',
                                            'choices' => array( 'confirm' => "Confirmée",
                                                                'onHold' => "En attente",
                                                                'refused' => "Refusée")))
            ->add('message', 'textarea', array('label' => 'Message'))
            ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LBF\UserBundle\Entity\Orders'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'lbf_userbundle_orders';
    }
}
