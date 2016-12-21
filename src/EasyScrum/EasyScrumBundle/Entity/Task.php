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
      * @ORM\ManyToOne(targetEntity="EasyScrum\EasyScrumBundle\Entity\UserStory", inversedBy="tasks")
      *
      */
    private $userStory ;

    /** une tache a un repsonsable
      * @ORM\ManyToOne(targetEntity="EasyScrum\EasyScrumBundle\Entity\User", inversedBy="tasks")
      * @ORM\JoinColumn(name="responsable_id")
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
}
