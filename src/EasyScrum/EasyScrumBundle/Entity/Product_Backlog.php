<?php

namespace EasyScrum\EasyScrumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product_Backlog
 *
 * @ORM\Table(name="product__backlog")
 * @ORM\Entity(repositoryClass="EasyScrum\EasyScrumBundle\Repository\Product_BacklogRepository")
 */
class Product_Backlog
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

