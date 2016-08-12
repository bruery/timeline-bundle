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

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $node = $treeBuilder->root('bruery_doctrine_orm_admin');
        $this->addSettingsSection($node);
        return $treeBuilder;
    }

    /**
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    private function addSettingsSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('settings')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->defaultValue('Bruery\\DoctrineORMAdminBundle\\Model\\SettingsManager')->end()
                        ->arrayNode('proxy_query')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->defaultValue('Bruery\\DoctrineORMAdminBundle\\Datagrid\\ProxyQuery')->end()
                            ->end()
                        ->end()
                        ->arrayNode('model_manager')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->defaultValue('Bruery\\DoctrineORMAdminBundle\\Model\\ModelManager')->end()
                            ->end()
                        ->end()
                        ->arrayNode('doctrine_cache')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('enabled')->defaultValue(true)->end()
                                ->scalarNode('ttl')->defaultValue(3600)->end()
                            ->end()  #--end audit children
                        ->end() #--end audit
                    ->end()
                ->end()
            ->end();
    }
}
