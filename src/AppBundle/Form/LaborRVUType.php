<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use NYULMC\ChargeCodeRequestBundle\Entity\SourceSystem;
use Doctrine\ORM\EntityRepository;

class LaborRVUType extends AbstractType
{
    private $requestId;

/*    public function __construct($requestId)
    {
        $this->requestId = $requestId;
    }*/

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        //$systems = $options['systems'];
//        $builder->add('requestId', 'hidden' );
        $builder->add('vrn', new LaborTimeType());
        $builder->add('vtech', new LaborTimeType());
        $builder->add('vot', new LaborTimeType());
        $builder->add('vpt', new LaborTimeType());
        $builder->add('vus', new LaborTimeType());
        $builder->add('vep', new LaborTimeType());
        $builder->add('vpsych', new LaborTimeType());
        $builder->add('vperf', new LaborTimeType());
        $builder->add('vsp', new LaborTimeType());
        $builder->add('vsw', new LaborTimeType());
        $builder->add('other', new LaborTimeType());
/*        $builder->add('save', 'submit',array(
            'attr' => array('class'=>'actionbutton')) );*/

    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\LaborRVU',
        ));
    }
    public function getName()
    {
        return 'ccRequest';
    }

}
