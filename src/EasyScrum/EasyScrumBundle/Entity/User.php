<?php

namespace EasyScrum\EasyScrumBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** un utilisaeur peut etre productOwner de plusieurs projet
      *@ORM\OneToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\Projet", mappedBy="productOwner")
      *@ORM\JoinColumn(name="id_myProject")
      */
      protected $mesProjets;

      /**
        * @ORM\ManyToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\Team", inversedBy="users")
       * @ORM\JoinTable(name="teams_users",
       *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
       *      inverseJoinColumns={@ORM\JoinColumn(name="team_id", referencedColumnName="id")}
       * )
       */
       protected $teams;

       /**
         * @ORM\OneToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\Team", mappedBy="admin")
        *  @ORM\JoinColumn(name="team_id", referencedColumnName="id")
        *
        */

        protected $myTeams; // les teams dont je suis admin

      /** un user participe a plusieurs projets
        * @ORM\ManyToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\Projet", inversedBy="collaborateurs")
        */

        protected $projets; //projets auxquels je collabore

      /** un user gère plusieurs taches
        * @ORM\OneToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\Task", mappedBy="responsable")
        */
        protected $tasks ;

        /**
          * @ORM\ManyToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\User")
          */

        protected $usersFriends;

    public function __construct()
    {
        parent::__construct();

        $this->projets = new ArrayCollection() ;
        $this->teams = new ArrayCollection();
        $this->myTeams = new ArrayCollection();
        $this->mesProjets = new ArrayCollection ();
        $this->tasks = new ArrayCollection();
    }


    // Retourne une ArrayCollection des nom des projets de l'utilisateur
  /*  public function getProjetsNames(){
      $projets  = $this->getProjets();

      $projetsNames = new ArrayCollection() ;
      foreach($projets->toArray() as $projet)
      {
        $projetsNames[] = $projet->getNom();
      }
      var_dump($projetsNames);
      return $projetsNames;
    }*/
    public function getMesProjets(){
       return $this->mesProjets ;
    }

    public function addMonProjet($projet){
       $this->mesProjets[] = $projet;
      return $this ;
    }
    public function removeMonProjet($projet){
      $this->mesProjets->removeElement($projet);
    }

    public function getProjets(){
       return $this->projets ;
    }

    public function addProjet($projet){
       $this->projets[] = $projet;
      return $this ;
    }
    public function removeProjet($projet){
      $this->projets->removeElement($projet);
    }

    public function getTeams(){
       return $this->teams;
    }
    public function addTeam($team){

       $this->teams[] = $team;
      return $this ;
    }
    public function removeTeam($team){
      $this->teams->removeElement($team);
    }

    public function getMyTeams(){
       return $this->myTeams;
    }
    public function addMyTeam($team){

       $this->myTeams[] = $team;
      return $this ;
    }
    public function removeMyTeam($team){
      $this->myTeams->removeElement($team);
    }

    public function getTasks(){
       return $this->tasks;
    }
    public function addTask($task){

       $this->tasks[] = $task;
      return $this ;
    }
    public function removeTask($task){
      $this->tasks->removeElement($task);
    }

    public function getFriends(){
       return $this->usersFriends;
    }
    public function addFriend($friend){

       $this->usersFriends[] = $friend;
      return $this ;
    }
    public function removeTfriend($friend){
      $this->usersFriends->removeElement($friend);
    }


}
?>
