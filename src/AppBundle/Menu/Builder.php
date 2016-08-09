<?php

namespace AppBundle\Menu;

use AppBundle\Controller\Form\AngularController;
use AppBundle\Controller\Form\AutocompleteExtensionController;
use AppBundle\Controller\Form\ColorPickerController;
use AppBundle\Controller\Form\DatePickerController;
use AppBundle\Controller\Form\EmbeddedTemplateController;
use AppBundle\Controller\Form\ExtensionToggleController;
use AppBundle\Controller\Form\Select2ExtensionController;
use AppBundle\Controller\Form\SwitcheryController;
use AppBundle\Controller\Form\TagsController;
use AppBundle\Controller\ModalsController;
use AppBundle\Controller\PjaxController;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $components = $menu->addChild('Components')->setExtra('icon', 'puzzle-piece fa-fw');
        $components->addChild(PjaxController::TITLE, ['route' => 'pjax'])->setExtra('icon', PjaxController::ICON);
        $components->addChild(ModalsController::TITLE, ['route' => 'modals'])->setExtra('icon', ModalsController::ICON);

        $this->menuForms($menu);

        $menu->addChild('Admin', ['route' => 'sonata_admin_dashboard'])
            ->setExtra('icon', ' fa-dashboard')
            ->setLinkAttribute('data-pjax', 'false');

        return $menu;
    }

    public function menuForms(ItemInterface $menu)
    {
        $menu = $menu->addChild('Form Widgets & Extensions')->setExtra('icon', 'edit fa-fw');
        $menu->addChild(EmbeddedTemplateController::TITLE, ['route' => 'form_widget_embedded_template'])
            ->setExtra('icon', EmbeddedTemplateController::ICON.' fa-fw');

        $menu->addChild(DatePickerController::TITLE, ['route' => 'form_widget_date_picker'])
            ->setExtra('icon', DatePickerController::ICON.' fa-fw');

        $menu->addChild(ColorPickerController::TITLE, ['route' => 'form_widget_color_picker'])
            ->setExtra('icon', ColorPickerController::ICON.' fa-fw');

        $menu->addChild('Switchery', ['route' => 'form_widget_switchery'])
            ->setExtra('icon', SwitcheryController::ICON.' fa-fw');

        $menu->addChild('Tags', ['route' => 'form_widget_tags'])
            ->setExtra('icon', TagsController::ICON.' fa-fw');

        $menu->addChild('Angular Controller', ['route' => 'form_widget_angular_controller'])
            ->setExtra('icon', AngularController::ICON.' fa-fw');

        $menu->addChild('divider', ['divider' => true]);

        $menu->addChild(ExtensionToggleController::TITLE, ['route' => 'form_extension_toggle'])
            ->setExtra('icon', ExtensionToggleController::ICON.' fa-fw');

        $menu->addChild(Select2ExtensionController::TITLE, ['route' => 'form_extension_select2'])
            ->setExtra('icon', Select2ExtensionController::ICON.' fa-fw');

        $menu->addChild(AutocompleteExtensionController::TITLE, ['route' => 'form_extension_auto_complete'])
            ->setExtra('icon', AutocompleteExtensionController::ICON.' fa-fw');

    }
}