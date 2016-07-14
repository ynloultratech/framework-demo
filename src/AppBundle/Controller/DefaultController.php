<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route(name="home", path="/")
     */
    public function indexAction()
    {
        return $this->render('index.html.twig');
    }

    protected function renderExample($parameters)
    {
        $parameters['icon']= constant(get_class($this) . '::ICON');;
        $parameters['title']= constant(get_class($this) . '::TITLE');;

        return $this->render("example.html.twig", $parameters);
    }
}
