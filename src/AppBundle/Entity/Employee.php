<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity
 */
class Employee
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
     * @ORM\Column(name="kerberos_id", type="string", length=255)
     */
    private $kerberosId;
    
    /**
     * @var ArrayCollection|ChargeCodeRequest[]
     *
     * @ORM\OneToMany(targetEntity="ChargeCodeRequest", mappedBy="requester")
     */
    private $requests;
    
    /**
     * @var ArrayCollection|ChargeCodeRequest[]
     *
     * @ORM\OneToMany(targetEntity="ChargeCodeRequest", mappedBy="deptAdminKId")
     */
    private $admin_requests;
    
    /**
     * @var ArrayCollection|ChargeCodeRequest[]
     *
     * @ORM\OneToMany(targetEntity="ChargeCodeRequest", mappedBy="assignee")
     */
    private $assinged_requests;

    /**
     * @return string
     */
    public function getKerberosId()
    {
        return $this->kerberosId;
    }

    /**
     * @param string $kerberosId
     */
    public function setKerberosId($kerberosId)
    {
        $this->kerberosId = $kerberosId;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $fName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="dept", type="string", length=255)
     */
    private $dept;

    /**
     * @return string
     */
    public function getDept()
    {
        return $this->dept;
    }

    /**
     * @param string $dept
     */
    public function setDept($dept)
    {
        $this->dept = $dept;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getFName()
    {
        return $this->fName;
    }

    /**
     * @param string $fName
     */
    public function setFName($fName)
    {
        $this->fName = $fName;
    }

    /**
     * @return string
     */
    public function getLName()
    {
        return $this->lName;
    }

    /**
     * @param string $lName
     */
    public function setLName($lName)
    {
        $this->lName = $lName;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
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
     * @return Employee
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
        return $this->getLName(). ", ". $this->getFName();
    }


    function __toString()
    {
        return (string)$this->getId();
    }
}
