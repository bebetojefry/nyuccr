<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use AppBundle\Entity\SourceSystem;
use AppBundle\Entity\Modifier;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ChargeCodeRequest
 *
 * @ORM\Table(name="charge_code_request")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ChargeCodeRequestRepository")
 */
class ChargeCodeRequest
{
    public function __construct() {
        $this->rvus = new ArrayCollection();
    }
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="requests", fetch="EAGER")
     * @ORM\JoinColumn(name="requester", referencedColumnName="id")
     **/
    private $requester;

    /**
     * @ORM\Column(name="dept_id", type="integer", nullable=true)
     */
    private $deptId;
   
    /**
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="admin_requests", fetch="EAGER")
     * @ORM\JoinColumn(name="dept_admin_k_id", referencedColumnName="id")
     **/
    private $deptAdminKId;


    /**
     * @ORM\Column(name="hcpcs", type="string", length=100)
     */
    private $hcpcs;

    /**
     * @ORM\Column(name="hcpcs_desc", type="string", length=2000)
     */
    private $hcpcsDesc;

    /**
     * @ORM\Column(name="modifier_id", type="integer", nullable=true)
     */
    private $modifierId;

    /**
     * @ORM\Column(name="assignee_id", type="integer", nullable=true)
     */
/*    private $assigneeId;*/

    /**
     * @ORM\Column(name="explanation", type="string", length=2000, nullable=true)
     */
    private $explanation;

    /**
     * 0=drafted, 1=submitted, 2=approved, 3=rejected
     * @ORM\Column(name="status", type="string", length=100)
     */
    private $status;

    /**
     * @ORM\Column(name="system_id", type="integer", nullable=true)
     */
    private $systemId;

    /**
     * @ORM\Column(name="comments", type="string", nullable=true)
     */
    private $comments;

    /**
     * @ORM\Column(name="approver_comment", type="string", length=2000, nullable=true)
     */
    private $approverComment;

    /**
     * @ORM\Column(name="price_consideration", type="string", length=2000, nullable=true)
     */
    private $priceConsideration;

    /**
     * @ORM\ManyToOne(targetEntity="SourceSystem", fetch="EAGER")
     * @ORM\JoinColumn(name="system_id", referencedColumnName="id")
     **/
    private $system;

    /**
     * @ORM\ManyToOne(targetEntity="Modifier", fetch="EAGER")
     * @ORM\JoinColumn(name="modifier_id", referencedColumnName="id")
     **/
    private $modifier;

    /**
     * @ORM\ManyToOne(targetEntity="Assignee", fetch="EAGER")
     * @ORM\JoinColumn(name="assignee_id", referencedColumnName="id")
     **/
/*    private $assignee;*/

    /**
     * @ORM\OneToMany(targetEntity="RVU", mappedBy="ccRequest", fetch="EAGER", cascade={"persist"})
     **/
    private $rvus;

    /**
     * @ORM\Column(name="eap_code", type="string", length=255, nullable=true)
     */
    private $eapCode;

    /**
     * @ORM\Column(name="cdm_explanation", type="string", length=2000, nullable=true)
     */
    private $cdmExplanation;

    /**
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(name="effective_date", type="date", nullable=true)
     */
    private $effectiveDate;

    /**
     * @ORM\ManyToOne(targetEntity="EpicDepartment", inversedBy="requests", fetch="EAGER")
     * @ORM\JoinColumn(name="dept_id", referencedColumnName="id")
     **/
    private $epicDept;

    /**
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="assinged_requests", fetch="EAGER")
     * @ORM\JoinColumn(name="assignee", referencedColumnName="id")
     **/
    private $assignee;

    /**
     * @ORM\Column(name="submit_date", type="date", nullable=true)
     */
    private $submittedDate;
    
    /**
     * @var ArrayCollection|Activity[]
     *
     * @ORM\OneToMany(targetEntity="Activity", mappedBy="request")
     */
    private $activities;

    /**
     * @return mixed
     */
    public function getSubmittedDate()
    {
        return $this->submittedDate;
    }

    /**
     * @param mixed $submittedDate
     */
    public function setSubmittedDate($submittedDate)
    {
        $this->submittedDate = $submittedDate;
    }

    /**
     * @return mixed
     */
    public function getAssignee()
    {
        return $this->assignee;
    }

    /**
     * @param mixed $assignee
     */
    public function setAssignee($assignee)
    {
        $this->assignee = $assignee;
    }


    /**
     * @return EpicDepartment
     */
    public function getEpicDept()
    {
        return $this->epicDept;
    }

    /**
     * @param mixed $epicDept
     */
    public function setEpicDept($epicDept)
    {
        $this->epicDept = $epicDept;
    }

    /**
     * @return mixed
     */
    public function getCdmExplanation()
    {
        return $this->cdmExplanation;
    }

    /**
     * @param mixed $cdmExplanation
     */
    public function setCdmExplanation($cdmExplanation)
    {
        $this->cdmExplanation = $cdmExplanation;
    }

    /**
     * @return mixed
     */
    public function getEapCode()
    {
        return $this->eapCode;
    }

    /**
     * @param mixed $eapCode
     */
    public function setEapCode($eapCode)
    {
        $this->eapCode = $eapCode;
    }

    /**
     * @return mixed
     */
    public function getEffectiveDate()
    {
        return $this->effectiveDate;
    }

    /**
     * @param mixed $effectiveDate
     */
    public function setEffectiveDate($effectiveDate)
    {
        $this->effectiveDate = $effectiveDate;
    }

    /**
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param integer $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getRvus()
    {
        return $this->rvus;
    }

    /**
     * @param mixed $rvus
     */
    public function setRvus($rvus)
    {
        $this->rvus = $rvus;
    }

    /**
     * @return mixed
     */
    public function getModifier()
    {
        return $this->modifier;
    }

    /**
     * @param mixed $modifier
     */
    public function setModifier($modifier)
    {
        $this->modifier = $modifier;
    }

    /**
     * @return mixed
     */
    public function getModifierId()
    {
        return $this->modifierId;
        //return $this->getModifier()->
    }

    /**
     * @param mixed $modifierId
     */
    public function setModifierId($modifierId)
    {
        $this->modifierId = $modifierId;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
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
     * @return mixed
     */
    public function getPriceConsideration()
    {
        return $this->priceConsideration;
    }

    /**
     * @param mixed $price
     */
    public function setPriceConsideration($priceConsideration)
    {
        $this->priceConsideration = $priceConsideration;
    }

    /**
     * Set requester
     *
     * @param Employee $requester
     */
    public function setRequester($requester)
    {
        $this->requester = $requester;
    }

    /**
     * Get requestor
     *
     * @return Employee
     */
    public function getRequester()
    {
        return $this->requester;
    }

    /**
     * Set deptId
     *
     * @param integer $deptId
     */
    public function setDeptId($deptId)
    {
        $this->deptId = $deptId;
    }

    /**
     * Get deptId
     *
     * @return integer
     */
    public function getDeptId()
    {
        return $this->deptId;
    }

    /**
     * Set deptAdminKId
     *
     * @param string $deptAdminKId
     */
    public function setDeptAdminKId($deptAdminKId)
    {
        $this->deptAdminKId = $deptAdminKId;
    }

    /**
     * Get deptAdminKId
     *
     * @return string
     */
    public function getDeptAdminKId()
    {
        return $this->deptAdminKId;
    }

    /**
     * Set hcpcs
     *
     * @param string $hcpcs
     */
    public function setHcpcs($hcpcs)
    {
        $this->hcpcs = $hcpcs;
    }

    /**
     * Get hcpcs
     *
     * @return string
     */
    public function getHcpcs()
    {
        return $this->hcpcs;
    }

    /**
     * Set hcpcsDesc
     *
     * @param string $hcpcsDesc
     */
    public function setHcpcsDesc($hcpcsDesc)
    {
        $this->hcpcsDesc = $hcpcsDesc;
    }

    /**
     * Get hcpcsDesc
     *
     * @return string
     */
    public function getHcpcsDesc()
    {
        return $this->hcpcsDesc;
    }

    /**
     * Set systemId
     *
     * @param integer $systemId
     */
    public function setSystemId($systemId)
        {
            $this->systemId = $systemId;
        }

    /**
     * Get systemId
     *
     * @return integer
     */
    public function getSystemId()
    {
        return $this->systemId;
    }
    /**
     * Set explanation
     *
     * @param string $explanation
     */
    public function setExplanation($explanation)
    {
        $this->explanation = $explanation;
    }

    /**
     * Get explanation
     *
     * @return string
     */
    public function getExplanation()
    {
        return $this->explanation;
    }

    /**
     * @return mixed
     */
    public function getSystem()
    {
        return $this->system;
    }

    /**
     * @param mixed $system
     */
    public function setSystem($system)
    {
        $this->system = $system;
    }

    function __toString()
    {
        return $this->getId(). $this->getRequester()->getKerberosId() . $this->getSystemId() . $this->getSystem();
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    public function addRVU(RVU $rvu)
    {
        $rvu->setCcRequest($this);
        $this->rvus->add($rvu);
    }

    public function removeRVU(RVU $rvu)
    {
        $this->rvus->remove($rvu);
    }

    /**
     * @return string
     */
    public function getApproverComment()
    {
        return $this->approverComment;
    }

    /**
     * @param string $approverComment
     */
    public function setApproverComment($approverComment)
    {
        $this->approverComment = $approverComment;
    }
    
    /**
     * Get activities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActivities(){
        return $this->activities;
    }
}
