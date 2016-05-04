<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table(name="user_activity")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ActivityRepository")
 */
class Activity
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
     * @ORM\Column(name="kerberosId", type="string", length=255)
     */
    private $kerberosId;

    /**
     * @var request
     *
     * @ORM\ManyToOne(targetEntity="ChargeCodeRequest", inversedBy="activities", cascade={"remove"}))
     * @ORM\JoinColumn(name="request_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $request;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", length=255)
     */
    private $action;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="actedOn", type="datetime")
     */
    private $actedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="actedTo", type="string", length=2000, nullable=true)
     */
    private $actedTo;


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
     * Set kerberosId
     *
     * @param string $kerberosId
     *
     * @return Activity
     */
    public function setKerberosId($kerberosId)
    {
        $this->kerberosId = $kerberosId;

        return $this;
    }

    /**
     * Get kerberosId
     *
     * @return string
     */
    public function getKerberosId()
    {
        return $this->kerberosId;
    }

    /**
     * Set request
     *
     * @param ChargeCodeRequest $request
     *
     * @return Activity
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Get request
     *
     * @return ChargeCodeRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Set action
     *
     * @param string $action
     *
     * @return Activity
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set actedOn
     *
     * @param \DateTime $actedOn
     *
     * @return Activity
     */
    public function setActedOn($actedOn)
    {
        $this->actedOn = $actedOn;

        return $this;
    }

    /**
     * Get actedOn
     *
     * @return \DateTime
     */
    public function getActedOn()
    {
        return $this->actedOn;
    }

    /**
     * Set actedTo
     *
     * @param integer $actedTo
     *
     * @return Activity
     */
    public function setActedTo($actedTo)
    {
        $this->actedTo = $actedTo;

        return $this;
    }

    /**
     * Get actedTo
     *
     * @return integer
     */
    public function getActedTo()
    {
        return $this->actedTo;
    }
}

