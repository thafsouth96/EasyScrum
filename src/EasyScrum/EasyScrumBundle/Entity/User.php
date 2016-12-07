<?php

namespace EasyScrum\EasyScrumBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
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
      *@ORM\OneToMany(targetEntity="EasyScrum\EasyScrumBundle\Entity\Projet", mappedBy="productOwner")
      *@ORM\JoinColumn(name="owner_projet", referencedColumnName="nom")
      */
      private $projets;

    public function __construct()
    {
        parent::__construct();

        $this->projets = new ArrayCollection() ;

    }

    public function getProjets(){
       return $this->projets ;
    }
    public function addProjet(Projet $projet){

       $this->projets[] = $projet;
      return $this ;
    }
    public function removeProjet(Projet $projet){
      $this->projets->removeElement($projet);
    }



}
?>
