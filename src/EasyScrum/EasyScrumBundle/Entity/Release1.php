<?php

namespace EasyScrum\EasyScrumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Release1
 *
 * @ORM\Table(name="release1")
 * @ORM\Entity(repositoryClass="EasyScrum\EasyScrumBundle\Repository\Release1Repository")
 */
class Release1
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
     * @var string
     *
     * @ORM\Column(name="projet", type="string", length=255, unique=true)
     */
    private $projet;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set projet
     *
     * @param string $projet
     *
     * @return Release1
     */
    public function setProjet($projet)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return string
     */
    public function getProjet()
    {
        return $this->projet;
    }
}

