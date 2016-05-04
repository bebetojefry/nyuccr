<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LaborRVU
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\LaborRVURepository")
 */
class LaborRVU
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
     * @ORM\Column(name="vrn_id", type="integer", nullable=true)
     */
    private $vrnId;

    /**
     * @ORM\ManyToOne(targetEntity="LaborTime", fetch="EAGER", cascade={"persist"} )
     * @ORM\JoinColumn(name="vrn_id", referencedColumnName="id")
     */
    private $vrn;

    /**
     * @var integer
     *
     * @ORM\Column(name="vtech", type="integer", nullable=true)
     */
    private $vtechId;

    /**
     * @ORM\ManyToOne(targetEntity="LaborTime", fetch="EAGER", cascade={"persist"})
     * @ORM\JoinColumn(name="vtech", referencedColumnName="id")
     */
    private $vtech;

    /**
     * @var integer
     *
     * @ORM\Column(name="vot", type="integer", nullable=true)
     */
    private $votId;

    /**
     * @ORM\ManyToOne(targetEntity="LaborTime", fetch="EAGER", cascade={"persist"})
     * @ORM\JoinColumn(name="vot", referencedColumnName="id")
     */
    private $vot;

    /**
     * @var integer
     *
     * @ORM\Column(name="vpt", type="integer", nullable=true)
     */
    private $vptId;

    /**
     * @ORM\OneToOne(targetEntity="LaborTime", fetch="EAGER", cascade={"persist"})
     * @ORM\JoinColumn(name="vpt", referencedColumnName="id")
     */
    private $vpt;

    /**
     * @var integer
     *
     * @ORM\Column(name="vus", type="integer", nullable=true)
     */
    private $vusId;

    /**
     * @ORM\OneToOne(targetEntity="LaborTime", fetch="EAGER", cascade={"persist"})
     * @ORM\JoinColumn(name="vus", referencedColumnName="id")
     */
    private $vus;

    /**
     * @var integer
     *
     * @ORM\Column(name="vep", type="integer", nullable=true)
     */
    private $vepId;

    /**
     * @ORM\OneToOne(targetEntity="LaborTime", fetch="EAGER", cascade={"persist"})
     * @ORM\JoinColumn(name="vep", referencedColumnName="id")
     */
    private $vep;

    /**
     * @return mixed
     */
    public function getVperf()
    {
        return $this->vperf;
    }

    /**
     * @param mixed $vperf
     */
    public function setVperf($vperf)
    {
        $this->vperf = $vperf;
    }

    /**
     * @return int
     */
    public function getVperfId()
    {
        return $this->vperfId;
    }

    /**
     * @param int $vperfId
     */
    public function setVperfId($vperfId)
    {
        $this->vperfId = $vperfId;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="vpsych", type="integer", nullable=true)
     */
    private $vpsychId;

    /**
     * @ORM\OneToOne(targetEntity="LaborTime", fetch="EAGER", cascade={"persist"})
     * @ORM\JoinColumn(name="vpsych", referencedColumnName="id")
     */
    private $vpsych;

    /**
     * @var integer
     *
     * @ORM\Column(name="vperf", type="integer", nullable=true)
     */
    private $vperfId;

    /**
     * @ORM\OneToOne(targetEntity="LaborTime", fetch="EAGER", cascade={"persist"})
     * @ORM\JoinColumn(name="vperf", referencedColumnName="id")
     */
    private $vperf;

    /**
     * @var integer
     *
     * @ORM\Column(name="vsp", type="integer", nullable=true)
     */
    private $vspId;

    /**
     * @ORM\OneToOne(targetEntity="LaborTime", fetch="EAGER", cascade={"persist"})
     * @ORM\JoinColumn(name="vsp", referencedColumnName="id")
     */
    private $vsp;

    /**
     * @var integer
     *
     * @ORM\Column(name="vsw", type="integer", nullable=true)
     */
    private $vswId;

    /**
     * @ORM\OneToOne(targetEntity="LaborTime", fetch="EAGER", cascade={"persist"})
     * @ORM\JoinColumn(name="vsw", referencedColumnName="id")
     */
    private $vsw;

    /**
     * @var integer
     *
     * @ORM\Column(name="other", type="integer", nullable=true)
     */
    private $otherId;

    /**
     * @ORM\OneToOne(targetEntity="LaborTime", fetch="EAGER", cascade={"persist"})
     * @ORM\JoinColumn(name="other", referencedColumnName="id")
     */
    private $other;

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
     * Set vrn
     *
     * @param integer $vrn
     * @return LaborRVU
     */
    public function setVrn($vrn)
    {
        $this->vrn = $vrn;

        return $this;
    }

    /**
     * Get vrn
     *
     * @return integer 
     */
    public function getVrn()
    {
        return $this->vrn;
    }

    /**
     * Set vtech
     *
     * @param integer $vtech
     * @return LaborRVU
     */
    public function setVtech($vtech)
    {
        $this->vtech = $vtech;

        return $this;
    }

    /**
     * Get vtech
     *
     * @return integer 
     */
    public function getVtech()
    {
        return $this->vtech;
    }

    /**
     * Set vot
     *
     * @param integer $vot
     * @return LaborRVU
     */
    public function setVot($vot)
    {
        $this->vot = $vot;

        return $this;
    }

    /**
     * Get vot
     *
     * @return integer 
     */
    public function getVot()
    {
        return $this->vot;
    }

    /**
     * Set vpt
     *
     * @param integer $vpt
     * @return LaborRVU
     */
    public function setVpt($vpt)
    {
        $this->vpt = $vpt;

        return $this;
    }

    /**
     * Get vpt
     *
     * @return integer 
     */
    public function getVpt()
    {
        return $this->vpt;
    }

    /**
     * Set vus
     *
     * @param integer $vus
     * @return LaborRVU
     */
    public function setVus($vus)
    {
        $this->vus = $vus;

        return $this;
    }

    /**
     * Get vus
     *
     * @return integer 
     */
    public function getVus()
    {
        return $this->vus;
    }

    /**
     * Set vep
     *
     * @param integer $vep
     * @return LaborRVU
     */
    public function setVep($vep)
    {
        $this->vep = $vep;

        return $this;
    }

    /**
     * Get vep
     *
     * @return integer 
     */
    public function getVep()
    {
        return $this->vep;
    }

    /**
     * Set vpsych
     *
     * @param integer $vpsych
     * @return LaborRVU
     */
    public function setVpsych($vpsych)
    {
        $this->vpsych = $vpsych;

        return $this;
    }

    /**
     * Get vpsych
     *
     * @return integer 
     */
    public function getVpsych()
    {
        return $this->vpsych;
    }

    /**
     * Set vsp
     *
     * @param integer $vsp
     * @return LaborRVU
     */
    public function setVsp($vsp)
    {
        $this->vsp = $vsp;

        return $this;
    }

    /**
     * Get vsp
     *
     * @return integer 
     */
    public function getVsp()
    {
        return $this->vsp;
    }

    /**
     * Set vsw
     *
     * @param integer $vsw
     * @return LaborRVU
     */
    public function setVsw($vsw)
    {
        $this->vsw = $vsw;

        return $this;
    }

    /**
     * Get vsw
     *
     * @return integer 
     */
    public function getVsw()
    {
        return $this->vsw;
    }

    /**
     * Set other
     *
     * @param integer $other
     * @return LaborRVU
     */
    public function setOther($other)
    {
        $this->other = $other;

        return $this;
    }

    /**
     * Get other
     *
     * @return integer 
     */
    public function getOther()
    {
        return $this->other;
    }
}
