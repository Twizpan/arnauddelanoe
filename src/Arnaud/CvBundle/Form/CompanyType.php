<?php

namespace Arnaud\CvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', 'text', array(
                                    'required' => true,
                                    'label'=>'Nom'
                                    ))
            ->add('Activity', 'text', array(
                                    'required' => false,
                                    'label'=>'Activité'
                                    ))
            ->add('Size', 'text', array(
                                    'required' => false,
                                    'label'=>'Taille'
                                    ))
            ->add('Location', 'text', array(
                                    'required' => false,
                                    'label'=>'Adresse'
                                    ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Arnaud\CvBundle\Entity\Company'
        ));
    }

    public function getName()
    {
        return 'arnaud_cvbundle_companytype';
    }
}
