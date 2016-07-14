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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use YnloFramework\YnloFormBundle\Form\Type\DateTimePickerType;
use YnloFramework\YnloModalBundle\Controller\ModalControllerTrait;

class ModalsController extends Controller
{
    const TITLE = 'Modals';
    const ICON = 'clone';

    use ModalControllerTrait;

    /**
     * @Route(path="/modals", name="modals")
     */
    public function indexAction()
    {
        return $this->render('modals/index.html.twig', ['icon' => self::ICON, 'title' => self::TITLE]);
    }

    /**
     * @Route(path="/modals/remote_content", name="modals_remote_content")
     */
    public function remoteContentAction()
    {
        $modal = $this->createModal('modals/remote_content.html.twig', [], 'Remote Content');

        return $this->renderModal($modal);
    }

    /**
     * @Route(path="/modals/remote_form", name="modals_remote_form")
     */
    public function remoteFormAction(Request $request)
    {
        $form = $this->createFormBuilder()->getForm();

        $form->add(
            'event', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ]
        );

        $form->add('date', DateTimePickerType::class);

        $form->handleRequest($request);

        $modal = $this->createModalForm($form->createView(), 'Remote Form');

        if ($request->get('customized')) {
            $modal->getButton('ok')->setLabel('SAVE')->setClass('btn-success')->setIcon('fa fa-check');
            $modal->getButton('close')->setLabel('CLOSE')->setClass('btn-danger pull-left')->setIcon('fa fa-times');
            $modal->setTypeSuccess();
        }

        if ($form->isValid()) {
            $event = $form->get('event')->getData();
            /** @var \DateTime $date */
            $date = $form->get('date')->getData();
            $this->addFlash('success', 'The event "' . $event . '" has been created for date: ' . $date->format('d.m.Y H:i:s'));

            return $this->ajaxRefresh();
        } elseif ($form->isSubmitted()) {
            $modal->setTypeDanger();
        }

        return $this->renderModal($modal);
    }
}