<?php

namespace PortfolioBundle\Entity;


use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="tags")
 */
class Tags extends AbstractTaxonomy{


    /**
     * @ORM\ManyToMany(targetEntity="Project", mappedBy="tags")
     * )
     */
    protected $projects;

}
