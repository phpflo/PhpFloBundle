<?php
/*
 * This file is part of the asm\phpflo-bundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\PhpFloBundle;

use Asm\PhpFloBundle\DependencyInjection\Compiler\ComponentRegistryCompilerPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;


/**
 * Class AsmPhpFloBundle
 *
 * @package Asm\PhpFloBundle
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class AsmPhpFloBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ComponentRegistryCompilerPass());
    }
}
