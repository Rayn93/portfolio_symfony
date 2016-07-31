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
    public function indexAction(){

        $ProjectRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Project');

        $qb = $ProjectRepo->getQueryBuilder(array(
            'home' => 'home'
        ));

        $query = $qb->getQuery();

        $projects = $query->getResult();


        return array(
            'projects' => $projects
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
