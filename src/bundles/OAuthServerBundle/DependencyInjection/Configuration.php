<?php
/**
 * This file is part of the Bruery Platform.
 *
 * (c) Viktore Zara <viktore.zara@gmail.com>
 * (c) Mell Zamorw <mellzamora@outlook.com>
 *
 * Copyright (c) 2016. For the full copyright and license information, please view the LICENSE  file that was distributed with this source code.
 */

namespace Bruery\OAuthServerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $node = $treeBuilder->root('bruery_oauth_server');
        $this->addManagerSection($node);
        $this->addModelSection($node);
        $this->addAdminSection($node);

        return $treeBuilder;
    }

    /**
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    private function addManagerSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('manager_class')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('orm')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('access_token')->defaultValue('Bruery\\OAuthServerBundle\\Entity\\AccessTokenManager')->end()
                                ->scalarNode('auth_code')->defaultValue('Bruery\\OAuthServerBundle\\Entity\\AuthCodeManager')->end()
                                ->scalarNode('client')->defaultValue('Bruery\\OAuthServerBundle\\Entity\\ClientManager')->end()
                                ->scalarNode('refresh_token')->defaultValue('Bruery\\OAuthServerBundle\\Entity\\RefreshTokenManager')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

      /**
     * @param \Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition $node
     */
    private function addAdminSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('admin')
                    ->addDefaultsIfNotSet()
                    ->children()
                       ->arrayNode('access_token')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->cannotBeEmpty()->defaultValue('Bruery\\OAuthServerBundle\\Admin\\AccessTokenAdmin')->end()
                                ->scalarNode('controller')->cannotBeEmpty()->defaultValue('SonataAdminBundle:CRUD')->end()
                                ->scalarNode('translation')->cannotBeEmpty()->defaultValue('BrueryOAuthServerBundle')->end()
                            ->end()
                        ->end()
                        ->arrayNode('client')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('class')->cannotBeEmpty()->defaultValue('Bruery\\OAuthServerBundle\\Admin\\ClientAdmin')->end()
                                ->scalarNode('controller')->cannotBeEmpty()->defaultValue('SonataAdminBundle:CRUD')->end()
                                ->scalarNode('translation')->cannotBeEmpty()->defaultValue('BrueryOAuthServerBundle')->end()
                            ->end()
                        ->end()
                ->end()
            ->end()
        ;
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    private function addModelSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('class')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('access_token')->defaultValue('AppBundle\\Entity\\OAuthServer\\AccessToken')->end()
                        ->scalarNode('auth_code')->defaultValue('AppBundle\\Entity\\OAuthServer\\AuthCode')->end()
                        ->scalarNode('client')->defaultValue('AppBundle\\Entity\\OAuthServer\\Client')->end()
                        ->scalarNode('refresh_token')->defaultValue('AppBundle\\Entity\\OAuthServer\\RefreshToken')->end()
                        ->scalarNode('user')->defaultValue('AppBundle\\Entity\\User\\User')->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
