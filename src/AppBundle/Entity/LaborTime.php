<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LaborTime
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\LaborTimeRepository")
 */
class LaborTime
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="pre_procedure", type="integer", nullable=true)
     */
    private $preProcedure;

    /**
     * @var integer
     *
     * @ORM\Column(name="on_procedure", type="integer", nullable=true)
     */
    private $onProcedure;

    /**
     * @var integer
     *
     * @ORM\Column(name="post_procedure", type="integer", nullable=true)
     */
    private $postProcedure;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set laborId
     *
     * @param integer $laborId
     * @return LaborTime
     */
    public function setLaborId($laborId)
    {
        $this->laborId = $laborId;

        return $this;
    }

    /**
     * Get laborId
     *
     * @return integer 
     */
    public function getLaborId()
    {
        return $this->laborId;
    }

    /**
     * Set preProcedure
     *
     * @param integer $preProcedure
     * @return LaborTime
     */
    public function setPreProcedure($preProcedure)
    {
        $this->preProcedure = $preProcedure;

        return $this;
    }

    /**
     * Get preProcedure
     *
     * @return integer 
     */
    public function getPreProcedure()
    {
        return $this->preProcedure;
    }

    /**
     * Set onProcedure
     *
     * @param integer $onProcedure
     * @return LaborTime
     */
    public function setOnProcedure($onProcedure)
    {
        $this->onProcedure = $onProcedure;

        return $this;
    }

    /**
     * Get onProcedure
     *
     * @return integer
     */
    public function getOnProcedure()
    {
        return $this->onProcedure;
    }
    /**
     * Set postProcedure
     *
     * @param integer $postProcedure
     * @return LaborTime
     */
    public function setPostProcedure($postProcedure)
    {
        $this->postProcedure = $postProcedure;

        return $this;
    }

    /**
     * Get postProcedure
     *
     * @return integer 
     */
    public function getPostProcedure()
    {
        return $this->postProcedure;
    }
}
