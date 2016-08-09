<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;

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
     *      "/dodaj-projekt",
     *      name="addProject",
     * )
     * @Template()
     */
    public function addProjectAction(Request $request)
    {
        $Project = new Project();
        $form = $this->createForm(ProjectType::class, $Project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $Project->getThumbnail();
            $fileName = $this->get('app.thumbnail_uploader')->upload($file);
            $Project->setThumbnail($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($Project);
            $em->flush();

            $message = 'Poprawnie dodałeś nowy projekt do bazy';
            $this->get('session')->getFlashBag()->add('success', $message);

            return $this->redirect($this->generateUrl('addProject', array('id' => $Project->getId())));
        }

        return array(
            'form' => $form->createView(),
            'project' => $Project
        );
    }


    /**
     * @Route(
     *      "/edutuj-projekt/{id}",
     *      name="addProject",
     *      requirements={"id"="\d+"},
     *      defaults={"id"=NULL}
     * )
     * @Template("AdminBundle:Projects:addProject.html.twig")
     */
    public function editProjectAction(Request $request, Project $Project)
    {
        $Project->setThumbnail(
            new File($this->getParameter('upload_directory').'/'.$Project->getThumbnail())
        );

        $form = $this->createForm(ProjectType::class, $Project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $Project->getThumbnail();
            $fileName = $this->get('app.thumbnail_uploader')->upload($file);
            $Project->setThumbnail($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($Project);
            $em->flush();

            $message = 'Poprawnie dokonałeś edycji projektu';
            $this->get('session')->getFlashBag()->add('success', $message);

            return $this->redirect($this->generateUrl('addProject', array('id' => $Project->getId())));
        }


        return array(
            'form' => $form->createView(),
            'project' => $Project
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
