<?php

namespace AppBundle\Controller\Form;

use AppBundle\Controller\DefaultController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use YnloFramework\YnloFormBundle\Form\Type\AngularControllerType;
use YnloFramework\YnloFormBundle\Form\Type\ColorPickerType;
use YnloFramework\YnloFormBundle\Form\Type\EmbeddedTemplateType;

class AngularController extends DefaultController
{
    const TITLE = 'Angular Controller';
    const ICON = 'font';

    /**
     * @Route(path="/form/widgets/angular_controller", name="form_widget_angular_controller")
     */
    public function defaultAction()
    {
        $form = $this->get('form.factory')->create();
        $form->add(
            'text', TextType::class, [
                'data' => 'Sample Text',
            ]
        );
        $form->add('bold', CheckboxType::class);
        $form->add(
            'size', ChoiceType::class, [
                'choices' => [
                    'H1' => 'h1',
                    'H2' => 'h2',
                    'H3' => 'h3',
                    'H4' => 'h4',
                    'H5' => 'h5',
                    'H6' => 'h6',
                ],
            ]
        );
        $form->add('color', ColorPickerType::class, ['data' => '#000000']);
        $form->add('background', ColorPickerType::class, ['data' => '#00ff00']);
        $form->add(
            'controller', AngularControllerType::class, [
                'controller_body' => 'forms\angular_controller\controller_body.js.twig',
                'angular_services' => ['$scope', '$log'],
                'angular_modules' => ['ngAnimate'],
            ]
        );
        $form->add(
            'sample', EmbeddedTemplateType::class, [
                'template' => 'forms\angular_controller\sample_text.html.twig',
            ]
        );

        return $this->renderExample(['form' => $form->createView()]);
    }
}
