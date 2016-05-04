<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * EpicDepartment
 *
 * @ORM\Table(name="epic_department")
 * @ORM\Entity
 */
class EpicDepartment implements JsonSerializable
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
     * from file upload
     * @ORM\Column(name="EPIC_DEPT_ID", type="integer")
     */
    private $epicDeptId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="FLAG", type="string", length=255, nullable=true)
     */
    private $flag;
    
    /**
     * @var ArrayCollection|ChargeCodeRequest[]
     *
     * @ORM\OneToMany(targetEntity="ChargeCodeRequest", mappedBy="epicDept")
     */
    private $requests;

    /**
     * @return string
     */
    public function getEpicDeptId()
    {
        return $this->epicDeptId;
    }

    /**
     * @param string $epicDeptId
     */
    public function setEpicDeptId($epicDeptId)
    {
        $this->epicDeptId = $epicDeptId;
    }

    /**
     * @return string
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * @param string $flag
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

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
     * @return EpicDepartment
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
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    function jsonSerialize()
    {
        return array(
            'id' => $this->getId(),
            'epicDeptId' => $this->getEpicDeptId(),
            'name' => $this->getName(),
            'status' => $this->getStatus(),
            'flag' => $this->getFlag()
        );
    }

    function __toString()
    {
        return $this->getName();
    }
    /*
     * Get requests
     * 
     * @return ArrayCollection|ChargeCodeRequest[]
     */
    public function getRequests(){
        return $this->requests;
    }
}
