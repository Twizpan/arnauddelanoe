<?php

namespace Arnaud\CvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Arnaud\CvBundle\Entity\Company
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Arnaud\CvBundle\Entity\CompanyRepository")
 */
class Company
{

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $Name
     *
     * @ORM\Column(name="Name", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Veuillez saisir un nom")
     */
    private $Name;

    /**
     * @var string $Activity
     *
     * @ORM\Column(name="Activity", type="string", length=511, nullable=true)
     */
    private $Activity;

    /**
     * @var integer $Size
     *
     * @ORM\Column(name="Size", type="integer", nullable=true)
     * @Assert\Min(limit = "1", message="Le nombre doit être supérieur à {{ limit }}", invalidMessage="Veuillez saisir un nombre")
     */
    private $Size;

    /**
     * @var string $Location
     *
     * @ORM\Column(name="Location", type="string", length=255, nullable=true)
     */
    private $Location;


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
     * Set Name
     *
     * @param string $name
     * @return Company
     */
    public function setName($name)
    {
        $this->Name = $name;
    
        return $this;
    }

    /**
     * Get Name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Set Activity
     *
     * @param string $activity
     * @return Company
     */
    public function setActivity($activity)
    {
        $this->Activity = $activity;
    
        return $this;
    }

    /**
     * Get Activity
     *
     * @return string 
     */
    public function getActivity()
    {
        return $this->Activity;
    }

    /**
     * Set Size
     *
     * @param integer $size
     * @return Company
     */
    public function setSize($size)
    {
        $this->Size = $size;
    
        return $this;
    }

    /**
     * Get Size
     *
     * @return integer 
     */
    public function getSize()
    {
        return $this->Size;
    }

    /**
     * Set Location
     *
     * @param string $location
     * @return Company
     */
    public function setLocation($location)
    {
        $this->Location = $location;
    
        return $this;
    }

    /**
     * Get Location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->Location;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->jobs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add jobs
     *
     * @param Arnaud\CvBundle\Entity\Job $jobs
     * @return Company
     */
    public function addJob(\Arnaud\CvBundle\Entity\Job $jobs)
    {
        $this->jobs[] = $jobs;
        $jobs->setCompany($this);
        return $this;
    }

    /**
     * Remove jobs
     *
     * @param Arnaud\CvBundle\Entity\Job $jobs
     */
    public function removeJob(\Arnaud\CvBundle\Entity\Job $jobs)
    {
        $this->jobs->removeElement($jobs);
        $jobs->setCompany(null);
    }

    /**
     * Get jobs
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getJobs()
    {
        return $this->jobs;
    }
}