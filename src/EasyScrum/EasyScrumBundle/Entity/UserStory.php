<?php

namespace EasyScrum\EasyScrumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserStory
 *
 * @ORM\Table(name="user_story")
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

