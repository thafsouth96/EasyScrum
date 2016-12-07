<?php

namespace EasyScrum\EasyScrumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\Group as BaseGroup;
/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="EasyScrum\EasyScrumBundle\Repository\TeamRepository")
 */
class Team extends BaseGroup
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
      *@ORM\OneToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\Projet", mappedBy="team")
      *@ORM\JoinColumn(name="team_projet", referencedColumnName="nom")
      */
    protected $projets;

    /**
      *@ORM\ManyToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\User", mappedBy="teams")
      */
    protected $users ;

    public function __construct()
    {
      $this->projets = new ArrayCollection() ;
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Team
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
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


    /**
     * Set fonction
     *
     * @param string $fonction
     *
     * @return Team
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    public function getProjets(){
      return $this->projets ;
    }

    public function addProjet(Projet $projet)
    {
      $this->projets[] = $projet;

      return $this;
    }

  public function removeProjet(Projet $projet)
  {
    $this->projets->removeElement($projet);
  }

  public function getUsers(){
    return $this->users ;
  }

  public function addUser(User $user)
  {
    $this->users[] = $user;

    return $this;
  }

public function removeUser(User $user)
{
  $this->users->removeElement($user);
}

}
