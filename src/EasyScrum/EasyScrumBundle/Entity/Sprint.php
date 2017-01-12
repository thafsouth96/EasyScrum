<?php

namespace EasyScrum\EasyScrumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sprint
 *
 * @ORM\Table(name="sprint")
 * @ORM\Entity(repositoryClass="EasyScrum\EasyScrumBundle\Repository\SprintRepository")
 */
class Sprint
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
      *
      * @ORM\Column(name="name", type="string")
      */
    private $name;

    /**
      * @var string
      *
      * @ORM\Column(name="description", type="string", length=255, nullable= true)
      */
    private $description;

    /**
      * @ORM\ManyToOne(targetEntity="EasyScrum\EasyScrumBundle\Entity\Projet", inversedBy="sprints")
      * @ORM\JoinColumn(name="projet_id")
      *
      * })
      */
    private $projet;

    /**
      * @ORM\ManyToOne(targetEntity="EasyScrum\EasyScrumBundle\Entity\Release1", inversedBy="sprints")
      * @ORM\JoinColumn(name="release_id")
      *
      * })
      */
    private $release;

    /**
     *@ORM\OneToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\UserStory", mappedBy="sprint")
     *
     */
     private $userStories; // Type = ArrayCollection

     /** une sprint a une teamResponsable
       * @ORM\ManyToOne(targetEntity="EasyScrum\EasyScrumBundle\Entity\Team", inversedBy="sprints")
       * @ORM\JoinColumn(name="team_id")
       *
       * })
       */
     private $teamResponsable;

     /**
       * @var Datetime
       *
       *@ORM\Column(name="dateStart", type="datetime", nullable= false)
       */
     private $dateStart ;
     /**
       * @var Datetime
       *
       *@ORM\Column(name="dateEnd", type="datetime", nullable= false)
       */
     private $dateEnd ;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName(){
      return $this->name ;
    }
    public function setName($name){
      $this->name = $name;
    }
    public function getDateStart(){
      return $this->dateStart;
    }

    public function setDateStart($date){
      $this->dateStart = $date ;
    }
    public function getDateEnd(){
      return $this->dateEnd ;
    }
    public function setDateEnd($date){
      $this->dateEnd = $date ;
    }
    public function getDescription(){
      return $this->description ;
    }
    public function setDescription($description){
      $this->description = $description ; 
    }
    public function getProjet(){
      return $this->projet ;
    }
    public function setProjet($projet){
      return $this->projet = $projet ;
    }

    public function getRelease(){
      return $this->release ;
    }
    public function setRelease($release){
      return $this->release = $release ;
    }

    public function getUserStories(){
      return $this->userStories;
    }
    public function addUserStory ($userStory){
      $this->userStories[] = $userStory ;
      return $this ;
    }
    public function removeUserStory($userStory){
      $this->userStories->removeElement($userStory);
    }

}
