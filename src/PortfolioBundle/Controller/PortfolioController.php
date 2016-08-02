<?php

namespace PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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

        //Rendering project with homePage = true
        $ProjectRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Project');

        $qb = $ProjectRepo->getQueryBuilder(array(
            'home' => 'home',
            'orderBy' => 'p.publishedDate',
            'orderDir' => 'DESC'
        ));

        $query = $qb->getQuery();
        $projects = $query->getResult();

        //Rendering a contact form

        $contactForm = $this->createFormBuilder()
                ->add('name', TextType::class)
                ->add('email', EmailType::class)
                ->add('massage', TextareaType::class)
                ->add('save', SubmitType::class, array('label' => 'WYŚLIJ'))
                ->getForm();



        return array(
            'projects' => $projects,
            'contactForm' => $contactForm->createView()
        );
    }

    /**
     * @Route(
     *      "/projekty/",
     *       name="portfolio_projects"
     * )
     * @Template("PortfolioBundle:Portfolio:projects_list.html.twig")
     */
    public function projectsAction()
    {
        $ProjectRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Project');

        $qb = $ProjectRepo->getQueryBuilder(array(
            'orderBy' => 'p.publishedDate',
            'orderDir' => 'DESC'
        ));

        $query = $qb->getQuery();
        $projects = $query->getResult();

        $CategoryRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Category');
        $AllCategory = $CategoryRepo->findAll();


        return array(
            'projects' => $projects,
            'title' => 'Projekty i realizacje',
            'all_projects' => 'WSZYSTKIE',
            'category_search' => true,
            'all_category' => $AllCategory
        );
    }

    /**
     * @Route(
     *      "/tag/{slug}",
     *      name="portfolio_projects_tags"
     * )
     * @Template("PortfolioBundle:Portfolio:projects_list.html.twig")
     */
    public function tagsAction($slug)
    {
        $ProjectRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Project');

        $qb = $ProjectRepo->getQueryBuilder(array(
            'orderBy' => 'p.publishedDate',
            'orderDir' => 'DESC',
            'tag' => $slug
        ));

        $query = $qb->getQuery();
        $projects = $query->getResult();

        $TagsRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Tags');
        $Tag = $TagsRepo->findOneBy(array('slug' => $slug));
        $TagsCloud = $TagsRepo->findAll();


        return array(
            'projects' => $projects,
            'tag_cloud' => $TagsCloud,
            'title' => sprintf("Projekty z tagiem: <span class=\"highlight\">%s</span>", $Tag->getName())
        );
    }

    /**
     * @Route(
     *      "/kategoria/{slug}",
     *       name="portfolio_projects_categories"
     * )
     * @Template("PortfolioBundle:Portfolio:projects_list.html.twig")
     */
    public function categoryAction($slug)
    {
        $ProjectRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Project');

        $qb = $ProjectRepo->getQueryBuilder(array(
            'orderBy' => 'p.publishedDate',
            'orderDir' => 'DESC',
            'category' => $slug
        ));

        $query = $qb->getQuery();
        $projects = $query->getResult();

        $CategoryRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Category');
        $CurrentCategory = $CategoryRepo->findOneBy(array('slug'=>$slug));
        $AllCategory = $CategoryRepo->findAll();


        return array(
            'projects' => $projects,
            'title' => sprintf("Projekty z kategorii: <span class=\"highlight\">%s</span>", $CurrentCategory->getName()),
            'current_category' => $CurrentCategory,
            'category_search' => true,
            'all_category' => $AllCategory
        );
    }
}
