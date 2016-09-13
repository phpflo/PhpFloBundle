<?php
/*
 * This file is part of the phpflo\phpflo-bundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpFlo\PhpFloBundle\Flow;

use PhpFlo\Builder\ComponentDiFinder;
use PhpFlo\PhpFloBundle\Common\BuilderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class DiNetworkBuilder
 *
 * @package PhpFlo\PhpFloBundle\Flow
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class DiNetworkBuilder extends AbstractNetworkBuilder implements BuilderInterface
{
    /**
     * @var string
     */
    protected $root;

    /**
     * @var ComponentBuilderInterface
     */
    protected $builder;

    /**
     * Builder constructor.
     *
     * @param ComponentRegistryInterface $registry
     * @param string $rootDir
     */
    public function __construct(ContainerInterface $container, $rootDir)
    {
        $this->builder = new ComponentDiFinder($container);
        $this->root = $rootDir . '/../app/config';
    }
}
