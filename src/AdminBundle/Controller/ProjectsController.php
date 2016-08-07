<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ProjectsController extends Controller
{
    /**
     * @Route(
     *      "/lista-projektow",
     *      name="listProject"
     * )
     * @Template()
     */
    public function listProjectAction()
    {
        $ProjectRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Project');

        $qb = $ProjectRepo->getQueryBuilder();

        $query = $qb->getQuery();
        $projects = $query->getResult();

        return array(
            'projects' => $projects
        );
    }


    /**
     * @Route(
     *      "/dodaj-projekt",
     *      name="addProject"
     * )
     * @Template()
     */
    public function addProjectAction()
    {
        return array();
    }


    /**
     * @Route(
     *      "/usun-projekt",
     *      name="deleteProject"
     * )
     * @Template()
     */
    public function deleteProjectAction()
    {
        return array();
    }
}
