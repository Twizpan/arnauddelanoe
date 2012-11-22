<?php

namespace Arnaud\CvBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Arnaud\CvBundle\Entity\Job
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Arnaud\CvBundle\Entity\JobRepository")
 */
class Job
{
    /**
     * @ORM\OneToOne(targetEntity="Arnaud\CvBundle\Entity\Company",cascade={"persist","remove"})
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $company;

    /**
     * @ORM\OneToMany(targetEntity="Task", mappedBy="Job",cascade={"persist"})
     **/
    private $tasks;


    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $position
     *
     * @ORM\Column(name="position", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Veuillez saisir un poste")
     */
    private $position;

    /**
     * @var \Date $start
     *
     * @ORM\Column(name="start", type="date", nullable=true)
     * @Assert\Date(message="Veuillez saisir une date valide")
     */
    private $start;

    /**
     * @var \Date $end
     *
     * @ORM\Column(name="end", type="date", nullable=true)
     * @Assert\Date(message="Veuillez saisir une date valide")
     */
    private $end;


    public function __construct()
    {
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set position
     *
     * @param string $position
     * @return Job
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return string 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     * @return Job
     */
    public function setStart($start)
    {
        $this->start = $start;
    
        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     * @return Job
     */
    public function setEnd($end)
    {
        $this->end = $end;
    
        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @Assert\True(message="Doit être plus récente que la date de début")
     */
    public function isEndValid()
    {
        var_dump($this->start);
        if(($this->end > $this->start) || is_null($this->start))
        {
            return true;
        }
        return false;
    }    

    /**
     * Set company
     *
     * @param Arnaud\CvBundle\Entity\Company $company
     * @return Job
     */
    public function setCompany(\Arnaud\CvBundle\Entity\Company $company = null)
    {
        $this->company = $company;
        
        return $this;
    }

    /**
     * Get company
     *
     * @return Arnaud\CvBundle\Entity\Company 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Add tasks
     *
     * @param Arnaud\CvBundle\Entity\Task $tasks
     * @return Job
     */
    public function addTask(\Arnaud\CvBundle\Entity\Task $tasks)
    {
        $this->tasks[] = $tasks;
        $tasks->setJob($this);
        return $this;
    }

    /**
     * Remove tasks
     *
     * @param Arnaud\CvBundle\Entity\Task $tasks
     */
    public function removeTask(\Arnaud\CvBundle\Entity\Task $tasks)
    {
        $this->tasks->removeElement($tasks);
    
        //$tasks->setJob(null);
    }

    /**
     * Get tasks
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTasks()
    {
        return $this->tasks;
    }

}