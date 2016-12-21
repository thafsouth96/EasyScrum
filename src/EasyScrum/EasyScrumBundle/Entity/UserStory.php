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
      * @ORM\ManyToOne(targetEntity="EasyScrum\EasyScrumBundle\Entity\Sprint", inversedBy="userStories")
      * @ORM\JoinColumn(name="sprint_id")
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
}
