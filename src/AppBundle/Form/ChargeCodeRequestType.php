<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityManager;
use AppBundle\Form\DataTransformer\DeptToNumberTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use NYULMC\ChargeCodeRequestBundle\Entity\SourceSystem;
use Doctrine\ORM\EntityRepository;

class ChargeCodeRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $builder->add('epicDept', 'autocomplete', array(
            'class' => 'AppBundle:EpicDepartment',
            'label' => 'Department'
        ));

        $builder->add('deptAdminKId', 'autocomplete', array(
            'class' => 'AppBundle:Employee',
            'label' => 'Department Admin'
        ));
        
        $builder->add('hcpcs', 'text', array('label' => 'HCPCS/CPT Code'));
        $builder->add('hcpcsDesc','text', array('label' => 'Procedure Name'));

        $builder->add('modifier','entity', array(
            'empty_value' => 'Choose a Modifier',
            'label' => 'Modifier',
            'class' => 'AppBundle:Modifier',
            'property' => 'name',
            'multiple'  => false
        ));

        $builder->add('system','entity', array(
            'empty_value' => 'Choose a System',
            'label' => 'Charge Capture Method',
            'class' => 'AppBundle:SourceSystem',
            'property' => 'name',
            'multiple'  => false
        ));
        $builder->add('explanation','textarea', array('label' => 'Explanation'));
        $builder->add('status','hidden', array('data' => '1'));
        $builder->add('priceConsideration','textarea', array('label' => 'Price Considerations','required' => false));
        $builder->add('save', 'submit',array(
            'attr' => array('class' => 'actionbutton btn-primary ladda-button', 'data-style' => 'expand-left'), 'label'=>'Save as Draft') );
        $builder->add('submit', 'submit',array(
            'attr' => array('class' => 'actionbutton btn-primary ladda-button', 'data-style' => 'expand-left'), 'label'=>'Submit') );

        $builder->add('rvus', 'collection', array(
            'label' => ' ',
            'type' => new RVUType(),
            'allow_add' => true,
            'by_reference' => false,
        ));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
/*        $resolver->setDefaults(array(
            'data_class' => 'NYULMC\ChargeCodeRequestBundle\Entity\ChargeCodeRequest',
        ));*/
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ChargeCodeRequest',
        ))->setRequired(array(
            'em',
        ))
            ->setAllowedTypes(array(
                'em' => 'Doctrine\Common\Persistence\ObjectManager',
            ));
    }
    public function getName()
    {
        return 'ccRequest';
    }
}
