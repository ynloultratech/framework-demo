<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace AppBundle\Admin;

use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use YnloFramework\YnloAdminBundle\Admin\AbstractAdmin;

/**
 * ContinentAdmin
 */
class ContinentAdmin extends AbstractAdmin
{
    protected $icon = 'fa fa-globe';

    protected $baseRoutePattern = 'continent';

    protected $onModal
        = [
            'delete',
            'create',
        ];

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('name')
            ->add(
                '_details',
                'details',
                [
                    'details_template' => ':admin:continents/list_details.html.twig',
                    'ajax' => true,
                ]
            )
            ->add(
                '_action',
                'actions',
                [
                    'dropdown' => true,
                    'actions' => [
                        'edit' => [],
                        'delete' => [],
                        'countries' => [
                            'icon' => 'fa fa-flag',
                            'divider' => 'prepend',
                            'template' => ':admin:continents/countries_child_link.html.twig',
                        ],
                    ],
                ]
            );
    }

    /**
     * {@inheritDoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('name');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $form)
    {
        if ($this->isCurrentRoute('create')) {
            $form->add('name');
        } else {
            $form->tab('Generals', ['icon' => 'fa fa-globe']);
            $form->with('Generals', ['icon' => 'fa fa-globe']);
            $form->add('name');
            $form->end();
            $form->end();

            $form->tab('Countries', ['icon' => 'fa fa-flag']);
            $form->with('Countries', ['icon' => 'fa fa-flag']);
            $form->add(
                'countries', 'sonata_type_collection', [], [
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                ]
            );
            $form->end();
        }
    }

    /**
     * @inheritDoc
     */
    protected function configureTabMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if ($action === 'edit' || $childAdmin) {
            $admin = $this->isChild() ? $this->getParent() : $this;
            $id = $admin->getRequest()->get('id');
            $container = $this->getConfigurationPool()->getContainer();

            $menu
                ->addChild(
                    'Generals',
                    [
                        'uri' => $this->generateObjectUrl('edit', $this->getSubject()),
                    ]
                )
                ->setCurrent($action === 'edit' && !$childAdmin);
            $menu
                ->addChild(
                    'Countries',
                    [
                        'uri' => $container->get('router')->generate('admin_app_continent_country_list', ['id' => $id]),
                    ]
                )
                ->setExtra('icon', 'fa fa-flag')
                ->setCurrent($childAdmin instanceof CountryAdmin);
        }
    }
}