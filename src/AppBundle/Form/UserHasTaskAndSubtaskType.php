<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserHasTaskAndSubtaskType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_id',EntityType::class, array(
                'placeholder' => 'Select User',
                'class' => 'AppBundle:User',
                'choice_label' => 'name',
                'attr' => ['class' => 'select2_multiple form-control'],
            ))
            ->add('task_id',EntityType::class, array(
                'placeholder' => 'Select Task',
                'class' => 'AppBundle:Task',
                'choice_label' => 'name',
                'attr' => ['class' => 'select2_multiple form-control'],
            ))
            ->add('subtask_id',EntityType::class, array(
                'placeholder' => 'Select Subtask',
                'class' => 'AppBundle:Subtask',
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
            'data_class' => 'AppBundle\Entity\UserHasTaskAndSubtask'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_userhastaskandsubtask';
    }


}
