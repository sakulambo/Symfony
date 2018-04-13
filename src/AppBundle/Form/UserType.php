<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, array(
                'required'   => true,
                'attr' => array(
                    'placeholder' => ' Insert Name ',
                    'class' => 'form-control has-feedback-left'
                )
            ))
            ->add('edad',NumberType::class, array(
                'required'   => true,
                'attr' => array(
                    'placeholder' => ' Insert Age ',
                    'class' => 'form-control'
                )
            ))

            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-success form-control'),
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
