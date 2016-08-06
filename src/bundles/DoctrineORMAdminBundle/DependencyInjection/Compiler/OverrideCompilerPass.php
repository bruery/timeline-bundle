<?php

/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamorw <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\DoctrineORMAdminBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class OverrideCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        //override TextBlockService
        $admin_pool = $container->getDefinition('sonata.admin.pool');
        $admin_pool->addMethodCall('setTemplates', array($container->getParameter('bruery_admin.configuration.templates')));

        $filter = $container->getDefinition('sonata.admin.orm.filter.type.boolean');
        $filter->setClass($container->getParameter('bruery_doctrine_orm_admin.filter.type.boolean.class'));

        $filter = $container->getDefinition('sonata.admin.orm.filter.type.choice');
        $filter->setClass($container->getParameter('bruery_doctrine_orm_admin.filter.type.choice.class'));

        $filter = $container->getDefinition('sonata.admin.orm.filter.type.class');
        $filter->setClass($container->getParameter('bruery_doctrine_orm_admin.filter.type.class.class'));

        $filter = $container->getDefinition('sonata.admin.orm.filter.type.date');
        $filter->setClass($container->getParameter('bruery_doctrine_orm_admin.filter.type.date.class'));

        $filter = $container->getDefinition('sonata.admin.orm.filter.type.date_range');
        $filter->setClass($container->getParameter('bruery_doctrine_orm_admin.filter.type.date_range.class'));

        $filter = $container->getDefinition('sonata.admin.orm.filter.type.datetime');
        $filter->setClass($container->getParameter('bruery_doctrine_orm_admin.filter.type.datetime.class'));

        $filter = $container->getDefinition('sonata.admin.orm.filter.type.datetime_range');
        $filter->setClass($container->getParameter('bruery_doctrine_orm_admin.filter.type.datetime_range.class'));

        $filter = $container->getDefinition('sonata.admin.orm.filter.type.number');
        $filter->setClass($container->getParameter('bruery_doctrine_orm_admin.filter.type.number.class'));

        $filter = $container->getDefinition('sonata.admin.orm.filter.type.string');
        $filter->setClass($container->getParameter('bruery_doctrine_orm_admin.filter.type.string.class'));

    }
}
