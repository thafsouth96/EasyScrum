<?php

namespace EasyScrum\EasyScrumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="EasyScrum\EasyScrumBundle\Repository\TeamRepository")
 */
class Team
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
     * @ORM\Column(name="fonction", type="string", length=255)
     */
    private $fonction;

    /**
      *@ORM\OneToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\Projet", mappedBy="team")
      *@ORM\JoinColumn(name="team_projet", referencedColumnName="nom")
      */
    private $projets;

    public function __construct()
    {
      $this->projets = new ArrayCollection() ;
    }

    /**
      *@ORM\ManyToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\User", mappedBy="teams")
      */
    private $users ;

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
