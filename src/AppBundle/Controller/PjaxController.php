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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class PjaxController extends Controller
{
    const TITLE = 'Pjax';
    const ICON = 'bolt';

    /**
     * @Route(path="/pjax",name="pjax")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createFormBuilder()->getForm();

        $form->add('name');
        $form->add('submit', SubmitType::class);

        $form->handleRequest($request);
        $name = false;
        if ($form->isValid()) {
            $name = $form->get('name')->getData();
        }

        return $this->render(
            'pjax/page1.html.twig', [
                'form' => $form->createView(),
                'data' => $form->getData(),
                'name' => $name,
                'title' => self::TITLE,
                'icon' => self::ICON
            ]
        );
    }

    /**
     * @Route(path="/pjax_sample/page2",name="pjax_page2")
     */
    public function page2Action()
    {
        return $this->render('pjax/page2.html.twig',[
            'title' => self::TITLE,
            'icon' => self::ICON
        ]);
    }
}