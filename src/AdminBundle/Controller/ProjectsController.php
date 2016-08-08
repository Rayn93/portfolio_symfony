<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use PortfolioBundle\Entity\Project;
use AdminBundle\Form\Type\ProjectType;

class ProjectsController extends Controller
{

    /**
     * @Route(
     *      "/lista-projektow/{page}",
     *      name="listProject",
     *      requirements={"page"="\d+"},
     *      defaults={"page"=1}
     * )
     *
     * @Template()
     */
    public function listProjectAction(Request $request, $page)
    {
        $queryParams = array(
            'titleLike' => $request->query->get('titleLike'),
            'categoryId' => $request->query->get('category')
        );

        $ProjectRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Project');
        $qb = $ProjectRepo->getQueryBuilder($queryParams);
        $query = $qb->getQuery();

        $paginationLimit = $this->getParameter('admin.pagination_limit');

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate($query, $page, $paginationLimit);

        $categoryList = $this->getDoctrine()->getRepository('PortfolioBundle:Category')->getAsArray();

        return array(
            'projects' => $pagination,
            'categoryList' => $categoryList
        );
    }


    /**
     * @Route(
     *      "/dodaj-projekt/{id}",
     *      name="addProject",
     *      requirements={"id"="\d+"},
     *      defaults={"id"=NULL}
     * )
     * @Template()
     */
    public function addProjectAction(Request $request)
    {

//        if($project == NULL){
//            $project = new Project();
//            $newProjectForm = true;
//        }

        //$project = new Project();

        $form = $this->createForm(ProjectType::class);

        return array(
            'form' => $form->createView()
        );
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
