<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use NYULMC\ChargeCodeRequestBundle\Entity\SourceSystem;
use Doctrine\ORM\EntityRepository;

class LaborTimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        //$systems = $options['systems'];
        $builder->add('preProcedure', 'text', array('label' => 'Pre-Procedure Time, e.g. Set-up','required' => false));
        $builder->add('onProcedure', 'text', array('label' => 'Procedure/ Visit Time','required' => false));
        $builder->add('postProcedure', 'text', array('label' => 'Post-Procedure Time, \n e.g. Clean-up, Patient Workup, Documentation','required' => false));
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\LaborTime',
        ));
    }
    public function getName()
    {
        return 'ccRequest';
    }
}
