<?php

namespace Jb\Bundle\DateNavigationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration.
 *
 * @author Jonathan Bouzekri <jonathan.bouzekri@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
    * {@inheritdoc}
    */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('jb_date_navigation');

        $rootNode
            ->children()
                ->scalarNode('permalink_year')
                    ->defaultValue('/:year/index.html')
                ->end()
                ->scalarNode('permalink_month')
                    ->defaultValue('/:year/:month/index.html')
                ->end()
            ->end();
        ;

        return $treeBuilder;
    }
}
