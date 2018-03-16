<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubtaskType extends AbstractType
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
            ->add('description',TextType::class, array(
                'required'   => true,
                'attr' => array(
                    'placeholder' => ' Insert Description ',
                    'class' => 'form-control has-feedback-left'
                )
            ))
            ->add('mainTask',EntityType::class, array(
                'placeholder' => 'Select Parent Task',
                'class' => 'AppBundle:Task',
                'choice_label' => 'name',
                'attr' => ['class' => 'select2_multiple form-control'],
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
            'data_class' => 'AppBundle\Entity\Subtask'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_subtask';
    }


}
