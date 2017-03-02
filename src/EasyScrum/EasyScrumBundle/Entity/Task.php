<?php

namespace EasyScrum\EasyScrumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="EasyScrum\EasyScrumBundle\Repository\TaskRepository")
 */
class Task
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
     * @var boolean
     *@ORM\Column(name="active", type="boolean", options={"default" : true})
     */
     private $active ;


    /**
      * @ORM\ManyToOne(targetEntity="EasyScrum\EasyScrumBundle\Entity\UserStory", inversedBy="tasks")
      *
      */
    private $userStory ;

    /** une tache a un repsonsable
      * @ORM\ManyToOne(targetEntity="EasyScrum\EasyScrumBundle\Entity\User", inversedBy="tasks")
      * @ORM\JoinColumn(name="responsable_id", onDelete="CASCADE")
      *
      * })
      */
    private $responsable;

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
    public function isActive(){
        return $this->active ;
    }
    public function setActive($active){
      $this->active = $active ;
    }
    public function getDescription(){
      return $this->description ;
    }
    public function setDescription($description){
      $this->description = $description ;
    }
}
