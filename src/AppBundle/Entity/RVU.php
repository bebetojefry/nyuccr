<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RVU
 *
 * @ORM\Table(name="rvu")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\RVURepository")
 */
class RVU
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="preProcedure", type="integer")
     */
    private $preProcedure;

    /**
     * @var integer
     *
     * @ORM\Column(name="onProcedure", type="integer")
     */
    private $onProcedure;

    /**
     * @var integer
     *
     * @ORM\Column(name="postProcedure", type="integer")
     */
    private $postProcedure;

    /**
     * @ORM\ManyToOne(targetEntity="ChargeCodeRequest", inversedBy="rvus", cascade={"remove"})
     * @ORM\JoinColumn(name="request_id", referencedColumnName="id", onDelete="CASCADE")
     **/
    private $ccRequest;

    /**
     * @var integer
     *
     * @ORM\Column(name="request_id", type="integer", nullable=true)
     */
    private $requestId;

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
     * Set name
     *
     * @param string $name
     * @return RVU
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set preProcedure
     *
     * @param integer $preProcedure
     * @return RVU
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
     * @return RVU
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
     * @return RVU
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


    /**
     * @return mixed
     */
    public function getCcRequest()
    {
        return $this->ccRequest;
    }

    /**
     * @param mixed $ccRequest
     */
    public function setCcRequest($ccRequest)
    {
        $this->ccRequest = $ccRequest;
    }

    /**
     * @return mixed
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @param mixed $requestId
     */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;
    }

    /**
     * @return integer
     */
    public function getTotal(){
        return $this->getPreProcedure() + $this->getOnProcedure() + $this->getPostProcedure();
    }
}
