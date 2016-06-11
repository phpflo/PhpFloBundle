<?php
/*
 * This file is part of the <package> package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\PhpFloBundle\Flow;

use Asm\PhpFloBundle\Common\BuilderInterface;
use Asm\PhpFloBundle\Common\NetworkInterface;
use Asm\PhpFloBundle\Common\RegistryInterface;
use PhpFlo\Graph;

/**
 * Class Builder
 *
 * @package Asm\PhpFloBundle\Flow
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class Builder implements BuilderInterface
{
    /**
     * @var string
     */
    private $root;

    /**
     * @var RegistryInterface
     */
    private $registry;

    /**
     * Builder constructor.
     *
     * @param RegistryInterface $registry
     * @param string $rootDir
     */
    public function __construct(RegistryInterface $registry, $rootDir)
    {
        $this->registry = $registry;
        $this->root = $rootDir . '/../app/config';
    }

    /**
     * @param string $fileName
     * @return NetworkInterface
     */
    public function fromFile($fileName)
    {
        // TODO: Implement fromFile() method.
    }

    /**
     * @param string $graph
     * @return NetworkInterface
     */
    public function fromString($graph)
    {
        // TODO: Implement fromString() method.
    }

    /**
     * @param Graph $graph
     * @return NetworkInterface
     */
    public function fromGraph(Graph $graph)
    {
        // TODO: Implement fromGraph() method.
    }
}
