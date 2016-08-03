<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CategoriesController extends Controller
{

    /**
     * @Route(
     *      "/lista-kategorii",
     *      name="listCategory"
     * )
     * @Template("AdminBundle::listTaxonomy.html.twig")
     */
    public function listCategoryAction()
    {
        return array(
            'pageTitle' => 'Kategorie'
        );
    }

    /**
     * @Route(
     *      "/dodaj-kategorie",
     *      name="addCategory"
     * )
     * @Template("AdminBundle::addTaxonomy.html.twig")
     */
    public function addCategoryAction()
    {
        return array(
            'pageTitle' => 'Kategorie'
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
