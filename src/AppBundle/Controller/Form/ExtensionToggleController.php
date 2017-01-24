<?php

namespace AppBundle\Controller\Form;

use AppBundle\Controller\DefaultController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use YnloFramework\YnloFormBundle\Form\Type\ColorPickerType;

class ExtensionToggleController extends DefaultController
{
    const TITLE = 'Form Toggle';
    const ICON = 'eye-slash';

    /**
     * @Route(path="/form/extensions/toggle",name="form_extension_toggle")
     */
    public function indexAction()
    {
        $form = $this->get('form.factory')->create();

        $form->add(
            'enabled', CheckboxType::class,
            [
                'toggle' => 'is_enabled',
            ]
        );

        $form->add(
            'Device', ChoiceType::class,
            [
                'choices' =>
                    [
                        '' => '',
                        'Mobile' => 'mobile',
                        'Pc' => 'pc',
                    ],
                'toggle_prefix' => 'device-',
                'toggle_group' => 'is_enabled',
            ]
        );

        $form->add(
            'mobile_color', ColorPickerType::class,
            [
                'toggle_group' => ['is_enabled', 'device-mobile'],
            ]
        );

        $form->add(
            'pc_type', ChoiceType::class,
            [
                'choices' =>
                    [
                        'Laptop' => 'laptop',
                        'Desktop' => 'desktop',
                    ],
                //'expanded' => true,//TODO: support for expanded choices (radios)
                'toggle_prefix' => 'pc-type-',
                'toggle_group' => ['is_enabled', 'device-pc'],
            ]
        );

        $form->add(
            'touch_screen', CheckboxType::class,
            [
                'toggle' => 'touch',
                'toggle_group' => ['is_enabled', 'device-pc', 'pc-type-laptop'],
            ]
        );

        $form->add(
            'screen_details', TextType::class,
            [
                'toggle_group' => ['is_enabled', 'device-pc', 'pc-type-laptop', 'not_touch'],
            ]
        );

        $form->add(
            'Brand', ChoiceType::class,
            [
                'choices' =>
                    [
                        '' => '',
                        'Samsung' => 'samsung',
                        'HP' => 'HP',
                        'Toshiba' => 'Toshiba',
                        'Sony' => 'Sony',
                    ],
                'toggle_prefix' => 'brand-',
                'toggle_group' => ['is_enabled', 'device-pc', 'pc-type-laptop'],
            ]
        );

        $form->add(
            'refurbished', CheckboxType::class,
            [
                'toggle_group' => ['is_enabled', 'device-pc', 'pc-type-laptop', 'not_brand-sony', 'not_brand-hp'],
            ]
        );


        return $this->renderExample(['form' => $form->createView()]);
    }
}
