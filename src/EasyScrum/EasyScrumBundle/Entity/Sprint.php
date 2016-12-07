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
     * Get id
     *
     * @return int
     */
     /**
       * @ORM\ManyToOne(targetEntity="EasyScrum\EasyScrumBundle\Entity\Projet", inversedBy="sprints", cascade={"remove"})
       * @ORM\JoinColumn(name="sprint_projet", referencedColumnName="nom")
       */
     private $projet ;


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
}
