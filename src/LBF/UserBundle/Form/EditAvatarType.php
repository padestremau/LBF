<?php
// src/LBF/UserBundle/Form/EditAvatarType.php

namespace LBF\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use LBF\UserBundle\Form\UserType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EditAvatarType extends UserType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', 'file')
            ;

        // On récupère la factory (usine)
        $factory = $builder->getFormFactory();
    }

    public function getName()
    {
        return 'UserBundle_EditAvatarType';
    }
}