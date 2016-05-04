<?php
/**
 * Created by PhpStorm.
 * User: zhaol02
 * Date: 3/30/2015
 * Time: 4:53 PM
 */
namespace AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use NYULMC\ChargeCodeRequestBundle\Entity\EpicDepartment;

class DeptToNumberTransformer  implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforms an object (epicdepartment) to a string (number).
     *
     * @param  Issue|null $issue
     * @return string
     */
    public function transform($epicDepartment)
    {
        if (null === $epicDepartment) {
            return "";
        }

        return $epicDepartment->getId();
    }

    /**
     * Transforms a string (number) to an object (EpicDepartment).
     *
     * @param  string $id
     *
     * @return EpicDepartment|null
     *
     * @throws TransformationFailedException if object (EpicDepartment) is not found.
     */
    public function reverseTransform($id)
    {
        if (!$id) {
            return null;
        }

        $epicDepartment = $this->om
            ->getRepository('AppBundle:EpicDepartment')
            ->findOneBy(array('id' => $id))
        ;

        if (null === $epicDepartment) {
            throw new TransformationFailedException(sprintf(
                'An issue with number "%s" does not exist!',
                $id
            ));
        }

        return $epicDepartment;
    }
}