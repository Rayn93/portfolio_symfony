<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PostsController extends Controller
{
    /**
     * @Route(
     *      "/dodaj-post",
     *      name="addPost"
     * )
     * @Template()
     */
    public function addPostAction()
    {
        return array();
    }

    /**
     * @Route(
     *      "/lista-postow",
     *      name="listPost"
     * )
     * @Template()
     */
    public function listPostAction()
    {
        return array();
    }
}
