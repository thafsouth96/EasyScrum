<?php
namespace EasyScrum\EasyScrumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserStory
 *
 * @ORM\Table(name="userStory")
 * @ORM\Entity(repositoryClass="EasyScrum\EasyScrumBundle\Repository\UserStoryRepository")
 */
class UserStory
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
      * @ORM\ManyToOne(targetEntity="EasyScrum\EasyScrumBundle\Entity\Sprint", inversedBy="userStories")
      * @ORM\JoinColumn(name="sprint_id", onDelete="CASCADE")
      *
      * })
      */
    private $sprint;

    /**
     *@ORM\OneToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\Task", mappedBy="userStory")
     *
     */
   private $tasks;

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
    public function getDescription(){
      return $this->description ;
    }
    public function setDescription($description){
      $this->description = $description ;
    }
}
