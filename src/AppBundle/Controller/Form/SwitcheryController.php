<?php

namespace AppBundle\Controller\Form;

use AppBundle\Controller\DefaultController;
use Symfony\Component\Routing\Annotation\Route;
use YnloFramework\YnloFormBundle\Form\Type\SwitcheryType;

class SwitcheryController extends DefaultController
{
    const TITLE = 'Switchery';
    const ICON = 'toggle-on';

    /**
     * @Route(path="/form/widgets/switchery", name="form_widget_switchery")
     */
    public function defaultAction()
    {
        $form = $this->get('form.factory')->create();
        $form->add('enabled', SwitcheryType::class);
        $form->add('disabled', SwitcheryType::class, ['disabled' => true]);
        $form->add(
            'custom_colors', SwitcheryType::class,
            [
                'sw_color' => '#faab43',
                'sw_secondaryColor' => '#fC73d0',
                'sw_jackColor' => '#fcf45e',
                'sw_jackSecondaryColor' => '#c8ff77',
            ]
        );
        $form->add(
            'small', SwitcheryType::class,
            [
                'sw_size' => 'small',
            ]
        );
        $form->add(
            'large', SwitcheryType::class,
            [
                'sw_size' => 'large',
                'data' => true,
            ]
        );

        return $this->renderExample(['form' => $form->createView()]);
    }
}
