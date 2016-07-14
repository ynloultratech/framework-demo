<?php

namespace AppBundle\Controller\Form;

use AppBundle\Controller\DefaultController;
use Symfony\Component\Form\ChoiceList\View\ChoiceView;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Routing\Annotation\Route;

class Select2ExtensionController extends DefaultController
{
    const TITLE = 'Select2';
    const ICON = 'indent';

    /**
     * @Route(path="/form/extensions/select2", name="form_extension_select2")
     */
    public function defaultAction()
    {
        $form = $this->get('form.factory')->create();
        $form->add(
            'choice', ChoiceType::class,
            [
                'choices' => [
                    'Linux' => 'linux',
                    'Windows' => 'windows',
                    'MacOS' => 'osx',
                    'IOS' => 'ios',
                    'Android' => 'Android',
                ],
                'label' => 'Select2 (Default)',
            ]
        );

        $form->add(
            'choice_multiple', ChoiceType::class,
            [
                'choices' => [
                    'Apple' => 'apple',
                    'Strawberry' => 'strawberry',
                    'Peach' => 'Peach',
                    'Grapes' => 'grapes',
                ],
                'multiple' => true,
                'label' => 'Select2 (Multiple)',
                'select2_template_result' => null,
            ]
        );

        $form->add(
            'choice_formatted', ChoiceType::class,
            [
                'choices' => [
                    'Paris' => 'France',
                    'London' => 'England',
                    'Madrid' => 'Spain',
                    'Washinton' => 'EEUU',
                    'Havana' => 'Cuba',
                ],
                'label' => 'Select2 (With Format)',
                'select2_template_result' => function (ChoiceView $choice) {
                    return '<h4 class="text-info">' . $choice->label . '</h4><h5>' . $choice->value . '</h6>';
                },
            ]
        );

        return $this->renderExample(['form' => $form->createView()]);
    }
}
