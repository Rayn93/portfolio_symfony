<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use PortfolioBundle\Entity\Category;

class CategoriesController extends Controller
{

    /**
     * @Route(
     *      "/lista-kategorii",
     *      name="listCategory"
     * )
     * @Template()
     */
    public function listCategoryAction()
    {
        $CategoryRepo = $this->getDoctrine()->getRepository('PortfolioBundle:Category');
        $AllCategory = $CategoryRepo->findAll();

        return array(
            'allCategory' => $AllCategory
        );
    }

    /**
     * @Route(
     *      "/dodaj-kategorie",
     *      name="addCategory"
     * )
     * @Template()
     */
    public function addCategoryAction()
    {
        return array(

        );
    }

    /**
     * @Route(
     *      "/usun-kategorie",
     *      name="deleteCategory"
     * )
     * @Template()
     */
    public function deleteCategoryAction()
    {
        return array();
    }
}
