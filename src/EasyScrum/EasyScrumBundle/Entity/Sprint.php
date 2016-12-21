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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    public function getProjet(){
      return $this->projet ;
    }
    public function setProjet(Projet $projet){
      return $this->projet = $projet ;
    }

    public function getRelease(){
      return $this->release ;
    }
    public function setRelease(Release $release){
      return $this->release = $release ;
    }

    public function getUserStories(){
      return $this->userStories;
    }
    public function addUserStory ($userStory){
      $this->userStories[] = $userStory ;
      return $this ;
    }
    public function removeUserStory(UserStory $userStory){
      $this->userStories->removeElement($userStory);
    }

}
