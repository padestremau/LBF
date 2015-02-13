<?php

namespace LBF\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrdersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $currentdate = new \DateTime('now');
        $hours = $currentdate->format('H');
        $hours = $hours + 2;
        $minutes = $currentdate->format('i');
        if ($minutes < 15) {
            $minutes = 15;
        }
        else if ($minutes < 30) {
            $minutes = 30;
        }
        else if ($minutes < 45) {
            $minutes = 45;
        }
        else {
            $minutes = '00';
            $hours = $hours + 1;
        }
        $day = $currentdate->format('d');
        $month = $currentdate->format('m');
        $year = $currentdate->format('Y');

        if ($hours < 10) {
            $hours = 10;
            $minutes = '00';
        }
        else if ($hours > 19) {
            $hours = 10;
            $minutes = '00';
            $day = $day + 1;
            $numberInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            if ($day > $numberInMonth) {
                $day = 1;
                $month = $month + 1;
                if ($month > 12) {
                    $month = 1;
                    $year = $year + 1;
                }
            }

        }

        $builder
            ->add('deliveryAt', 'datetime', array(
                                            'input'  => 'datetime',
                                            // 'format' => 'dd - MMMM - yyyy',
                                            'widget' => 'choice',
                                            'hours' => range(10,19,1),
                                            'minutes' => range(0,45,15),
                                            'years' => range(2015,2050,1),
                                            'data' => new \DateTime()
                                            // 'placeholder' => array('year' => $year, 'month' => $month, 'day' => $day, 'minute' => $minutes, 'hour' => $hours)
                                        ))
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
