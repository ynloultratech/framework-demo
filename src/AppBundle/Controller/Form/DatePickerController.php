<?php

namespace AppBundle\Controller\Form;

use AppBundle\Controller\DefaultController;
use Symfony\Component\Routing\Annotation\Route;
use YnloFramework\YnloFormBundle\Form\Type\DatePickerType;
use YnloFramework\YnloFormBundle\Form\Type\DateTimePickerType;

class DatePickerController extends DefaultController
{
    const TITLE = 'Date & Time Picker';
    const ICON = 'calendar';

    /**
     * @Route(path="/form/widgets/date_picker", name="form_widget_date_picker")
     */
    public function defaultAction()
    {
        $form = $this->get('form.factory')->create();
        $form->add(
            'date_picker', DateTimePickerType::class,
            [
                'label' => 'Date & Time',
                'dp_defaultDate' => 'now',
                'help_label_popover' => [
                    'title' => 'Label popover title',
                    'content' => 'Content for popover help, can include <strong>HTML</strong>'
                ],
            ]
        );
        $form->add(
            'date_picker_date', DatePickerType::class, [
                'label' => 'Date',
                'dp_defaultDate' => 'now'
            ]
        );

        return $this->renderExample(['form' => $form->createView()]);
    }
}
