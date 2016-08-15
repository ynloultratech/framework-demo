<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace AppBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use YnloFramework\YnloAdminBundle\Admin\AbstractAdmin;

/**
 * CountryAdmin
 */
class CountryAdmin extends AbstractAdmin
{
    protected $icon = 'fa fa-flag';

    protected $parentAssociationMapping = 'continent';

    protected $baseRoutePattern = 'country';

    protected $onModal
        = [
            'delete',
            'edit',
            'create',
        ];

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('name')
            ->add('iso', null, ['editable' => true])
            ->add('currency')
            ->add('currencyCode')
            ->add('continent')
            ->add(
                '_action',
                'actions',
                [
                    'dropdown' => true,
                    'actions' => [
                        'edit' => [],
                        'delete' => [],
                    ],
                ]
            );
    }

    /**
     * {@inheritDoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('name')
            ->add('iso')
            ->add('currency')
            ->add('continent');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form->add('name');
        $form->add('iso');
        $form->add('currency');
        $form->add('currencyCode');
        $form->add('phoneCode');
        $form->add(
            'continent',
            null,
            [
                'autocomplete' => 'name',
            ]
        );
    }
}