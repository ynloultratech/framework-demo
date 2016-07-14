<?php

namespace AppBundle\Controller\Form;

use AppBundle\Controller\DefaultController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use YnloFramework\YnloFormBundle\Form\Type\TagsType;

class TagsController extends DefaultController
{
    const TITLE = 'Tags';
    const ICON = 'tags';

    /**
     * @Route(path="/form/widgets/tags", name="form_widget_tags")
     */
    public function defaultAction(Request $request)
    {
        $form = $this->get('form.factory')->create();
        $form->add('tags', TagsType::class);

        $form->add(
            'tags_predefined', TagsType::class,
            [
                'label' => 'Tags (Predefined tags)',
                'choices' => [
                    'php' => 'php',
                    'html' => 'html',
                    'javascript' => 'javascript',
                    'css' => 'css',
                ]
            ]
        );
        return $this->renderExample(['form' => $form->createView()]);
    }
}
