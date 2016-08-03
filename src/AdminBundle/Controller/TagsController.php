<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TagsController extends Controller
{
    /**
     * @Route(
     *      "/lista-tagow",
     *      name="listTag"
     * )
     * @Template("AdminBundle::listTaxonomy.html.twig")
     */
    public function listTagAction()
    {
        return array(
            'pageTitle' => 'Tagi'
        );
    }

    /**
     * @Route(
     *      "/dodaj-tag",
     *      name="addTag"
     * )
     * @Template("AdminBundle::addTaxonomy.html.twig")
     */
    public function addTagAction()
    {
        return array(
            'pageTitle' => 'Tag'
        );
    }


}
