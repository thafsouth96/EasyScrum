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
      * @ORM\Column(name="nom" , type="string")
      */
    private $nom;

    /**
      * @var string
      *
      * @ORM\Column(name="description", type="string", length=255)
      */
    private $description ;

    /**
      * @var Datetime
      *
      *@ORM\Column(name="dateLivraisonP", type="datetime")
      */
    private $dateLivraisonP ;

    /**
      * @var Datetime
      *
      *@ORM\Column(name="dateLivraisonR", type="datetime")
      */
    private $dateLivraisonR ;

    /**
      * @ORM\ManyToOne(targetEntity="EasyScrum\EasyScrumBundle\Entity\Projet")
      */

    private $projet ;



    public function __construct($nom,$projet){

      $this->nom = $nom ;
      $this->projet=$projet;
      $this->description = null ;
      $this->dateLivraisonR = null ;
      $this->dateLivraisonP = new \Datetime("now" , new DateTimezone("Europe/Paris"));
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
    public function setProjet(Projet $projet){
      return $this->projet = $projet ;
    }

}
