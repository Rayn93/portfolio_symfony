<?php

namespace PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PortfolioController extends Controller
{
    /**
     * @Route(
     *      "/",
     *      name="portfolio_main"
     * )
     * @Template()
     */
    public function indexAction()
    {
        return array(

        );
    }

    /**
     * @Route(
     *      "/projekty/",
     *      name="portfolio_projects"
     * )
     * @Template()
     */
    public function projectsAction()
    {
        return array(

        );
    }
}