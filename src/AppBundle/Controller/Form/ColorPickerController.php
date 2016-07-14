<?php

namespace AppBundle\Controller\Form;

use AppBundle\Controller\DefaultController;
use Symfony\Component\Routing\Annotation\Route;
use YnloFramework\YnloFormBundle\Form\Type\ColorPickerType;

class ColorPickerController extends DefaultController
{
    const TITLE = 'Color Picker';
    const ICON = 'eyedropper';

    /**
     * @Route(path="/form/widgets/color_picker", name="form_widget_color_picker")
     */
    public function defaultAction()
    {
        $form = $this->get('form.factory')->create();
        $form->add(
            'spectrum_color_picker', ColorPickerType::class,
            [
                'label' => 'Color (Default)',
                'cp_color' => '#0000ff',
            ]
        );
        $form->add(
            'color_picker_palette', ColorPickerType::class,
            [
                'label' => 'Color (Only Palette)',
                'cp_showPaletteOnly' => true,
                'cp_color' => '#ff00ff',
            ]
        );
        $form->add(
            'color_picker_no_palette', ColorPickerType::class,
            [
                'label' => 'Color (Without palette)',
                'cp_showPalette' => false,
                'cp_color' => '#00ffff',
            ]
        );
        $form->add(
            'color_picker_custom_palette', ColorPickerType::class,
            [
                'label' => 'Color (Custom palette)',
                'cp_palette' => ['#ff00ff', '#ff0000', '#0000ff'],
                'cp_showPaletteOnly' => true,
                'cp_color' => '#ff0000',
            ]
        );
        $form->add(
            'color_picker_flat', ColorPickerType::class,
            [
                'label' => 'Color (Flat)',
                'cp_flat' => true,
                'cp_color' => '#45818e',
            ]
        );

        return $this->renderExample(['form' => $form->createView()]);
    }
}
