<?php
// src/AppBundle/Entity/Group.php

namespace EasyScrum\EasyScrumBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="team")
 *@ORM\Entity(repositoryClass="EasyScrum\EasyScrumBundle\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id;



     /**
      * @ORM\Column(type="string", nullable=false)
      */
    protected $nom;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
   protected $description;

    /**
     *@ORM\ManyToOne(targetEntity="EasyScrum\EasyScrumBundle\Entity\User", inversedBy="myTeams",  cascade={"ALL"})
     */
     protected $admin ;

    /**
    * @ORM\ManyToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\User", mappedBy="teams")
    * )
    */
    protected $users;

    /** Une équipe peut gérer plusieurs projets ==> Many teams have Many projects
      * @ORM\ManyToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\Projet", mappedBy="teams")
      */
    protected $projets;

    /** une team gère plusieurs teams
     *@ORM\OneToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\Sprint", mappedBy="teamResponsable")
     *
     */
     private $sprints;

     public function getNom(){
       return $this->nom ;
     }
     public function setNom($nom){
       $this->nom = $nom ;
       return $this ;
     }
     public function setDescription($description){
       $this->description = $description;
       return $this;
     }
     public function getDescription(){
      return $this->description ;
     }

     public function getAdmin(){
       return $this->admin ;
     }
     public function setAdmin(User $admin){
       $this->admin = $admin ;
     }

     public function getUsers(){
       return $this->users ;
     }

     public function addUser(User $user){
       $this->users[] = $user;
       return $this ;
     }
     public function removeUser(User $user){
       $this->users->removeElement($user) ;
     }
}
