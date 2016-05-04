<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use NYULMC\ChargeCodeRequestBundle\Entity\SourceSystem;
use Doctrine\ORM\EntityRepository;

class RejectChargeCodeRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('approverComment',  'textarea', array('label' => 'Comments', 'attr' => array('style' => 'height:200px;')));
        $builder->add('reject', 'submit',array(
            'attr' => array('class'=> 'actionbutton btn btn-primary ladda-button', 'data-style' => 'expand-left')) );
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ChargeCodeRequest',
        ));
    }
    public function getName()
    {
        return 'ccRequest';
    }
}
