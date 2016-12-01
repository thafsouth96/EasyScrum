<?php

namespace EasyScrum\EasyScrumBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

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
      *@ORM\ManyToOne(targetEntity="EasyScrum\EasyScrumBundle\Entity\Projet")
      *
      */
      private $projets;

    public function __construct()
    {
        parent::__construct();

    }

    public function getProjets(){
       return $this->projets ;
    }
    public function addProjet(Projet $projet){
      $this->projets[] = $projet ;
      return $this ;
    }
    public function removeProjet(Projet $projet){
      $this->projets->removeElement($projet);
    }



}
?>
