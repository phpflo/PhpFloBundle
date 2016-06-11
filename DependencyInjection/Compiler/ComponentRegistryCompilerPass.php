<?php
/*
 * This file is part of the asm\phpflo-bundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\PhpFloBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ComponentRegistryCompilerPass
 *
 * @package Asm\PhpFloBundle\DependencyInjection\Compiler
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class ComponentRegistryCompilerPass implements CompilerPassInterface
{
    /**
     * process compiler pass.
     *
     * @param ContainerBuilder $container
     * @throws \ErrorException
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('asm_phpflo.component_registry')) {
            return;
        }
        $definition = $container->getDefinition(
            'asm_phpflo.component_registry'
        );
        $taggedServices = $container->findTaggedServiceIds(
            'asm_phpflo.component'
        );
        foreach ($taggedServices as $id => $attributes) {
            if (!isset($attributes[0]['alias'])) {
                throw new \ErrorException('Please define an alias for ' . $id . ' service for mapping!');
            }
            $definition->addMethodCall(
                'addReference',
                array(
                    new Reference($id),
                    $attributes[0]['alias']
                )
            );
        }
    }
}
