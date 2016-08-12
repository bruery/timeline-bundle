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
use Symfony\Component\DependencyInjection\Reference;

class OverrideCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->getParameter('bruery.doctrine_orm_admin.settings.doctrine_cache.enabled')) {
            $definition = $container->getDefinition('sonata.admin.manager.orm');
            $definition->setClass($container->getParameter('bruery.doctrine_orm_admin.settings.model_manager.class'));
            $definition->addMethodCall('setSettingsManager', array(new Reference('bruery.doctrine_orm_admin.settings.manager')));
        }
    }
}
