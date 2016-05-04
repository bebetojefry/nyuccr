<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use NYULMC\ChargeCodeRequestBundle\Entity\SourceSystem;
use Doctrine\ORM\EntityRepository;

class RVUType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('requestId', 'hidden');
        //$builder->add('name', 'text', array('label' =>'Name'));
        $builder->add('name', 'choice', array(
            'choices'   => array(
                'Exercise Physiologists (VEP)'   => 'Exercise Physiologists (VEP)',
                'Occupational Therapist (VOT)'   => 'Occupational Therapist (VOT)',
                'Perfusionist (VPERF)'   => 'Perfusionist (VPERF)',
                'Physical Therapist (VPT)'   => 'Physical Therapist (VPT)',
                'Psychologists (VPSYCH)'   => 'Psychologists (VPSYCH)',
                'Register Nurse (VRN)'   => 'Register Nurse (VRN)',
                'Speech Specialist (VSP)'   => 'Speech Specialist (VSP)',
                'Swallowing Specialist (VSW)'   => 'Swallowing Specialist (VSW)',
                'Technologist (VTECH)' => 'Technologist (VTECH)',
                'Ultrasound Technician (VUS)'   => 'Ultrasound Technician (VUS)',
            ),
        ));
        $builder->add('preProcedure', 'integer', array('label' =>'Pre-Procedure', 'required' => true, 'attr' => array('min' => 0, 'style' => 'width: 90px')));
        $builder->add('onProcedure', 'integer', array('label' =>'Procedure', 'required' => true, 'attr' => array('min' => 0, 'style' => 'width: 90px')));
        $builder->add('postProcedure', 'integer', array('label' =>'Post-Procedure', 'required' => true, 'attr' => array('min' => 0, 'style' => 'width: 90px')));
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\RVU',
        ));
    }
    public function getName()
    {
        return 'rvu';
    }

}
