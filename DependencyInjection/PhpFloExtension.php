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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class PhpFloExtension
 *
 * @package PhpFlo\PhpFloBundle\DependencyInjection
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class PhpFloExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration(
            $container->getParameter('kernel.root_dir'),
            $container->getParameter('kernel.logs_dir')
        );

        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');

        $container->setParameter('phpflo_bundle.log_dir', $config['logging']['directory']);
        $container->setParameter('phpflo_bundle.configuration_dir', $config['config']['directory']);

        if (isset($config['logging']['enabled']) && true === $config['logging']['enabled']) {
            if (empty($config['logging']['service'])) {
                // use default logger service, if not exists, create
                if (!$container->hasDefinition('phpflo.flowtrace.default_logger')) {
                    $loggerClass = $container->getParameter('phpflo_bundle.default_logger_class');

                    if (class_exists($loggerClass)) {
                        $container->setDefinition(
                            'phpflo.flowtrace.default_logger',
                            new Definition(
                                $loggerClass,
                                [
                                    $config['logging']['directory'] . DIRECTORY_SEPARATOR . $config['logging']['name'],
                                    $config['logging']['level'],
                                ]
                            )
                        );
                    } else {
                        throw new InvalidArgumentException(
                            "The class {$loggerClass} does not exist, require phpflo/flowtrace dependency!"
                        );
                    }
                }
            }

            $networkDefinition = new Definition(
                $container->getParameter('phpflo_bundle.traceable_network_class'),
                [
                    new Reference('phpflo.network.component.builder'),
                    new Reference ('phpflo.flowtrace.default_logger'),
                ]
            );
        } else {
            $networkDefinition = new Definition(
                $container->getParameter('phpflo_bundle.network_class'),
                [
                    new Reference('phpflo.network.component.builder'),
                ]
            );
        }

        if (!$container->hasDefinition('phpflo.network.component.builder')) {
            $container->setDefinition(
                'phpflo.network.component.builder',
                new Definition(
                    $container->getParameter('phpflo_bundle.component.builder_class'),
                    [
                        new Reference('service_container'),
                        $config['config']['directory']
                    ]
                )
            );
        }

        if (!$container->hasDefinition('phpflo.network.network')) {
            $container->setDefinition(
                'phpflo.network.network',
                $networkDefinition
            );
        }

        if (!$container->hasDefinition('phpflo.network')) {
            $container->setDefinition(
                'phpflo.network',
                new Definition(
                    $container->getParameter('phpflo_bundle.builder_class'),
                    [
                        new Reference('phpflo.network.network')
                    ]
                )
            );
        }
    }
}
