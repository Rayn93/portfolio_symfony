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
     * @Template()
     */
    public function listTagAction()
    {
        return array(

        );
    }

    /**
     * @Route(
     *      "/dodaj-tag",
     *      name="addTag"
     * )
     * @Template()
     */
    public function addTagAction()
    {
        return array(

        );
    }

    /**
     * @Route(
     *      "/usun-tag",
     *      name="deleteTag",
     *      requirements={"id"="\d+"}
     * )
     *
     * @Template()
     */
    public function deleteTagAction()
    {


        return array(

        );
    }


}
