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

    /**
      *@ORM\OneToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\Projet", mappedBy="productOwner")
      *@ORM\JoinColumn(name="owner_projet")
      */
      protected $projets;

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




    public function __construct()
    {
        parent::__construct();

        $this->projets = new ArrayCollection() ;
        $this->teams = new ArrayCollection();
        $this->myTeams = new ArrayCollection();

    }

    public function getProjets(){
       return $this->projets ;
    }
    // Retourne une ArrayCollection des nom des projets de l'utilisateur
    public function getProjetsNames(){
      $projets  = $this->getProjets();

      $projetsNames = new ArrayCollection() ;
      foreach($projets->toArray() as $projet)
      {
        $projetsNames[] = $projet->getNom();
      }
      var_dump($projetsNames);
      return $projetsNames;
    }

    public function addProjet(Projet $projet){
       $this->projets[] = $projet;
      return $this ;
    }
    public function removeProjet(Projet $projet){
      $this->projets->removeElement($projet);
    }

    public function getTeams(){
       return $this->teams;
    }
    public function addTeam(Team $team){

       $this->teams[] = $team;
      return $this ;
    }
    public function removeTeam(Team $team){
      $this->teams->removeElement($team);
    }

    public function getMyTeams(){
       return $this->MyTeams;
    }
    public function addMyTeam(Team $team){

       $this->MyTeams[] = $team;
      return $this ;
    }
    public function removeMyTeam(Team $team){
      $this->MyTeams->removeElement($team);
    }


}
?>
