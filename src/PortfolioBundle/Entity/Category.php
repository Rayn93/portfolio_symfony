<?php

namespace PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="category")
 */
class Category extends AbstractTaxonomy{

    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="category")
     */
    protected $projects;



}
