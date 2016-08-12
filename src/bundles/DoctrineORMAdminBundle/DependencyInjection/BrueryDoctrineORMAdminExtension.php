<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamora <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\DoctrineORMAdminBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class BrueryDoctrineORMAdminExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('settings.xml');
        $this->configureSettings($config, $container);
    }

    /**
     * @param array                                                   $config
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     *
     * @return void
     */
    public function configureSettings($config, ContainerBuilder $container)
    {
        $container->setParameter('bruery.doctrine_orm_admin.settings.manager.clas',             $config['settings']['class']);
        $container->setParameter('bruery.doctrine_orm_admin.settings.proxy_query.class',        $config['settings']['proxy_query']['class']);
        $container->setParameter('bruery.doctrine_orm_admin.settings.model_manager.class',      $config['settings']['model_manager']['class']);
        $container->setParameter('bruery.doctrine_orm_admin.settings',                          $config['settings']['doctrine_cache']);
        $container->setParameter('bruery.doctrine_orm_admin.settings.doctrine_cache.enabled',   $config['settings']['doctrine_cache']['enabled']);
        $container->setParameter('bruery.doctrine_orm_admin.settings.doctrine_cache.ttl',       $config['settings']['doctrine_cache']['ttl']);

        if ($config['settings']['doctrine_cache']['enabled']) {
            $definition = $container->getDefinition('bruery.doctrine_orm_admin.settings.manager');
            $definition->addMethodCall('setConfig', array('doctrine_cache',  $config['settings']['doctrine_cache']));
        }
    }
}
