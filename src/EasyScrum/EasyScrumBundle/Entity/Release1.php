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
      * @ORM\Id
      * @ORM\Column(type="integer")
      * @ORM\GeneratedValue(strategy="AUTO")
      */
      protected $id;

      /**
        *
        * @ORM\Column(name="nom", type="string")
        */
      private $nom;

      /**
        * @var string
        *
        * @ORM\Column(name="description", type="string", length=255, nullable= true)
        */
      private $description ;

    /**
      * @var Datetime
      *
      *@ORM\Column(name="dateLivraisonP", type="datetime", nullable= true)
      */
    private $dateLivraisonP ;

    /**
      * @var Datetime
      *
      *@ORM\Column(name="dateLivraisonR", type="datetime", nullable= true)
      */
    private $dateLivraisonR ;

    /**
      * @ORM\ManyToOne(targetEntity="EasyScrum\EasyScrumBundle\Entity\Projet", inversedBy="releases")
      * @ORM\JoinColumn(name="projet_id")
      *
      * })
      */

    private $projet ;

    /**
     *@ORM\OneToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\Sprint", mappedBy="release")
     *
     */
     private $sprints; // Type = ArrayCollection

    public function __construct(){

    }

    public function __construct1($nom,$projet){

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

    public function getNom(){
      return $this->nom ;
    }
    public function setNom($nom){
       $this->nom = $nom ;
    }

    public function getDateLivraisonP(){
       return $this->dateLivraisonP ;
    }
    public function setDateLivraisonP($date){
      $this->dateLivraisonP = $date ;
    }

    public function getDateLivraisonR(){
      return $this->dateLivraisonR ;
    }

    public function setDateLivraisonR($date){
        $this->dateLivraisonR = $date ;
    }


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
    public function setProjet($projet){
      return $this->projet = $projet ;
    }
    public function getSprints(){
      return $this->sprints ;
    }
    public function addSprint(){
    
    }

}
