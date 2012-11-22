<?php

namespace Arnaud\CvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;



class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('Company',  new CompanyType())
            ->add('Position', 'text', array(
                                    'required' => true,
                                    'label'=>'Poste'
                                    ))
            ->add('Start', 'date', array(
                                        'required' => false,
                                        'label'  => 'Début',
                                        'widget' => 'choice',
                                        'format' => 'dd-MM-yyyy',
                                        'empty_value' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'),
                                        'years' => range(date('Y') -40, date('Y')),
                                        'invalid_message' => 'Veuillez saisir une date valide'
                                        ))
            ->add('End', 'date', array(
                                        'required' => false,
                                        'label'  => 'Fin',
                                        'widget' => 'choice',
                                        'format' => 'dd-MM-yyyy',
                                        'empty_value' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'),
                                        'years' => range(date('Y') -40, date('Y')),
                                        'invalid_message' => 'Veuillez saisir une date valide'
                                        ))
            ->add('tasks',  'collection', array(
                                            'required' => false,
                                            'label'        => 'Tâches',
                                            'type'         => new TaskType(),
                                            'allow_add'    => true,
                                            'allow_delete' => true,
                                            'by_reference' => false
                                            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Arnaud\CvBundle\Entity\Job',
            'cascade_validation' => true,
            'error_mapping' => array(
                'endValid' => 'End',
            ),
        ));
    }

    public function getName()
    {
        return 'arnaud_cvbundle_jobtype';
    }
}
