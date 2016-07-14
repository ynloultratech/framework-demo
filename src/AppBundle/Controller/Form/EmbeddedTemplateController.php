<?php

namespace AppBundle\Controller\Form;

use AppBundle\Controller\DefaultController;
use Symfony\Component\Routing\Annotation\Route;
use YnloFramework\YnloFormBundle\Form\Type\EmbeddedTemplateType;

class EmbeddedTemplateController extends DefaultController
{
    const TITLE = 'Embedded Template';
    const ICON = 'share-square';

    /**
     * @Route(path="/form/widgets/embedded_template",name="form_widget_embedded_template")
     */
    public function indexAction()
    {
        $form = $this->createFormBuilder()->getForm();

        $form->add('name');
        $form->add('intro', EmbeddedTemplateType::class, ['template' => 'forms/embedded_template/intro.html.twig']);
        $form->add('country');
        $form->add(
            'embedded2', EmbeddedTemplateType::class, [
                'template' => 'forms/embedded_template/embedded2.html.twig',
                'parameters' => ['ip_address' => $this->get('request_stack')->getCurrentRequest()->getClientIp()]
            ]
        );

        return $this->renderExample(['form' => $form->createView()]);
    }
}
