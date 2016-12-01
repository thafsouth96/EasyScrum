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
     * @ORM\Column(name="description", type="string", length=255, nullable= true)
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
       * @var Datetime
       *@ORM\Column(name="dateDebut", type="datetime", nullable = true)
       */
       private $dateDebut ;

      /**
        * @var Datetime
        *@ORM\Column(name="dateFin", type="datetime", nullable=true)
        */
         private $dateFin;
     /**
       * @var Datetime
       *@ORM\Column(name="maj", type="datetime", nullable=true)
      */
        private $maj;

    /**
      *@var int
      * @ORM\Column(name="budget", type="integer", nullable=true)
      */
      private $budget ;

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

    /**
      *@ORM\ManyToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\Team")
      *
      */
      private $teams ;

    /**
      *@ORM\ManyToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\User")
      *
      */
        private $collaborateurs;
    /**
      *@ORM\ManyToOne(targetEntity="EasyScrum\EasyScrumBundle\Entity\User")
      *
      */
      private $productOwner ;



      public function __construct(){
        $this->dateDebut = null ;
        $this->dateFin = null ;
        $this->maj = null ;
        $this->budget = null ;
        $this->productOwner=null ;
        $this->description = null ;
        $this->nom = null  ;
        $this->active = true;
        $this->collaborateurs = new ArrayCollection();
        $this->teams = new ArrayCollection() ;
        $this->releases = new ArrayCollection();
        $this->sprints = new ArrayCollection();
        $this->dateCreation = new \Datetime("now"); //aujourd'hui

      }


  /*    public function __construct1($nom,$active){

          $this->nom = $nom ;
          $this->active = $active ;
          $this->collaborateurs = new ArrayCollection();
          $this->teams = new ArrayCollection() ;
          $this->releases = new ArrayCollection();
          $this->sprints = new ArrayCollection();
          $this->dateCreation = new \Datetime("now" );
      }*/

      public function __construct2($nom){
        $this->dateDebut = null ;
        $this->dateFin = null ;
        $this->maj = null ;
        $this->budget = null ;
        $this->productOwner=null ;
        $this->nom = $nom ;
        $this->active = true;
        $this->teams = new ArrayCollection() ;
        $this->releases = new ArrayCollection();
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

    public function getDateDebut(){
      return $this->dateDebut ;
    }

    public function setDateDebut($date){
      $this->dateDebut = $date ;
    }

    public function getDateFin(){
      return $this->dateFin ;
    }

    public function setDateFin($date){
      $this->dateFin = $date ;
    }

    public function getMaj(){
      return $this->Maj ;
    }

    public function setMaj($date){
      $this->Maj = $date ;
    }

    public function getBudget(){
      return $this->budget ;
    }

    public function setBudget($budget){
      $this->dateDebut = $budget;
    }

    public function getProductOwner(){
      return $this->productOwner ;
    }

    public function setProductOwner($user){
      $this->productOwner = $user ;
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

    public function getTeams(){
      return $this->teams;
    }

    public function addTeam(Team $team){
      $this->teams[] = $team ;
      return $this ;
    }
    public function removeTeam(Team $team){
      $this->teams->removeElement($team);
    }

    public function getCollaborateur(){
      return $this->collaborateurs;
    }

    public function addCollaborateur(User $user){
      $this->collaborateurs[] = $user ;
      return $this ;
    }
    public function removeCollaborateur(User $user){
      $this->collaborateurs->removeElement($user);
    }



}
