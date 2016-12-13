<?php
// src/AppBundle/Entity/Group.php

namespace EasyScrum\EasyScrumBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_group")
 */
class Team extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id;

    /**
     *@ORM\ManyToOne(targetEntity="EasyScrum\EasyScrumBundle\Entity\User", inversedBy="myTeams",  cascade={"ALL"})
     */
     protected $admin ;

    /**
    * @ORM\ManyToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\User", mappedBy="teams")
    * )
    */
    protected $users;

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
