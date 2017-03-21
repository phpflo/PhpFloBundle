<?php
/*
 * This file is part of the phpflo\phpflo-bundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhpFlo\PhpFloBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package PhpFlo\PhpFloBundle\DependencyInjection
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @var string
     */
    private $rootDir;

    /**
     * @var string
     */
    private $kernelLogsDir;

    /**
     * Configuration constructor.
     *
     * @param string $rootDir
     * @param string $kernelLogsDir
     */
    public function __construct($rootDir, $kernelLogsDir)
    {
        $this->rootDir = $rootDir;
        $this->kernelLogsDir = $kernelLogsDir;
    }

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $defaultConfigDir = $this->rootDir . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'phpflo';
        /** @var \Symfony\Component\Config\Definition\Builder\TreeBuilder $treeBuilder */

        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('phpflo_bundle');

        $rootNode
            ->children()
                ->arrayNode('config')
                    ->children()
                        ->scalarNode('directory')
                            ->defaultValue($defaultConfigDir)
                            ->info('Directory where your fbp files are located.')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('logging')
                    ->children()
                        ->booleanNode('enabled')
                            ->info('Enables flowtrace logger.')
                            ->defaultFalse()
                        ->end()
                        ->scalarNode('level')
                            ->defaultValue('info')
                            ->info('Up from which level should be logged?')
                        ->end()
                        ->scalarNode('directory')
                            ->defaultValue($this->kernelLogsDir)
                            ->info('Directory to store flowtrace logs.')
                        ->end()
                        ->scalarNode('name')
                            ->defaultValue('phpflo.log')
                            ->info('Default name for your log.')
                        ->end()
                        ->scalarNode('service')
                            ->info('PSR-3 compatible logger service')
                            ->defaultNull()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
