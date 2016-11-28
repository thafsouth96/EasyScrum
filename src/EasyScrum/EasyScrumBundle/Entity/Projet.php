<?php

namespace EasyScrum\EasyScrumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection ;

/**
 * Projet
 *
 * @ORM\Table(name="projet")
 * @ORM\Entity(repositoryClass="EasyScrum\EasyScrumBundle\Repository\ProjetRepository")
 */
class Projet
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
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
      * @var Datetime
      *@ORM\Column(name="dateCreation", type="datetime")
      */
      private $dateCreation ;

    /**
     * @var boolean
     *@ORM\Column(name="active", type="boolean", options={"default" : true})
     */
     private $active ;

     /**
      *@ORM\OneToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\Release1", mappedBy="projet")
      *
      */
      private $releases; // Type = ArrayCollection


    /**
      *@ORM\OneToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\Sprint", mappedBy="projet")
      *
      */
      private $sprints;

    /**
      *@ORM\OneToOne(targetEntity="EasyScrum\EasyScrumBundle\Entity\Product_Backlog", cascade={"persist"})
      *
      */
      private $product_backlog ;

      public function __construct(){
        $this->description = null ;
        $this->nom = null  ;
        $this->active = true;
        $this->releases = new ArrayCollection();
        $this->sprints = new ArrayCollection();
        $this->dateCreation = new \Datetime("now"); //aujourd'hui

      }


      public function __construct1($nom,$active){

          $this->nom = $nom ;
          $this->active = $active ;
          $this->releases = new ArrayCollection();
          $this->sprints = new ArrayCollection();
          $this->dateCreation = new \Datetime("now" );
      }

      public function __construct2($nom){
        $this->nom = $nom ;
        $this->active = true;
        $this->releases = new ArrayCollection();
        $this->sprints = new ArrayCollection();
        $this->dateCreation = new \Datetime("now" ); //aujourd'hui

      }

    public function setBacklogP(Product_Backlog $pb = null){
        $this->product_backlog = $pb ;
    }

    public function getBacklogP(){
      return $this->product_backlog;
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
     /**
      * Get dateCreation
      *
      * @return Datetime
      */

    public function getDateCreation(){

        return $this->dateCreation ;
    }

    public function setDateCreation($date){

        $this->dateCreation = $date ; 
    }

    /**
      * Set date
      *
      *@param Datetime $dateCreation
      *
      */
    public function setDatetime($date){

        $this->dateCreation = $date ;
    }

    public function isActive(){

        return $this->active ;
    }

    public function setActive(boolean $active){

      $this->active = $active ;
    }
    /**
     * Set nom
     *
     * @param string $nom
     *
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    public function getDescription(){

      return $this->description;
    }

    public function setDescription($description){
      $this->description = $description;
    }
    public function getReleases(){
      return $this->releases ;
    }

    public function addRelease(Release1 $release){
      $this->releases[] = $release;
      return $this ;
    }
    public function removeRlease(Release1 $release){
      $this->releases->removeElement($release) ;
    }

    public function getSprints(){
      return $this->sprints;
    }

    public function addSprint(Sprint $sprint){
      $this->sprints[] = $sprint ;
      return $this ;
    }
    public function removeSprint(Sprint $sprint){
      $this->sprints->removeElement($sprint);
    }

}
