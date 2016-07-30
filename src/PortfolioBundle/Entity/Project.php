<?php

namespace PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="project")
 */
class Project{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150, unique=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $thumbnail;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="projects")
     * @ORM\JoinColumn(
     *      name ="category_id",
     *      referencedColumnName="id",
     *      onDelete="SET NULL"
     * )
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="Tags", inversedBy="projects")
     * @ORM\JoinTable(name="portfolio_tags")
     * )
     */
    private $tags;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $link;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publishedDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $homePage = false;


}