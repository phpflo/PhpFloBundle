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

use PhpFlo\PhpFloBundle\Common\BuilderInterface;
use PhpFlo\Builder\ComponentDiFinder;
use PhpFlo\Common\ComponentBuilderInterface;
use PhpFlo\Common\ComponentRegistryInterface;
use PhpFlo\Graph;
use PhpFlo\Network;

/**
 * Class Builder
 *
 * @package PhpFlo\PhpFloBundle\Flow
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class NetworkBuilder implements BuilderInterface
{
    /**
     * @var string
     */
    private $root;

    /**
     * @var ComponentBuilderInterface
     */
    private $builder;

    /**
     * Builder constructor.
     *
     * @param ComponentRegistryInterface $registry
     * @param string $rootDir
     */
    public function __construct(ComponentRegistryInterface $registry, $rootDir)
    {
        $this->builder = new ComponentDiFinder($registry);
        $this->root = $rootDir . '/../app/config';
    }

    /**
     * @Todo maybe find a cached solution for that?
     *
     * @param string $fileName
     * @return Network
     * @throws \InvalidArgumentException
     */
    public function fromFile($fileName)
    {
        $fileUri = $this->root . '/' . ltrim($fileName, '/');

        if (file_exists($fileUri)) {
            $graph = file_get_contents($fileUri);
        } else {
            throw new \InvalidArgumentException('Could not find file ' . $fileUri);
        }

        return $this->fromString($graph);
    }

    /**
     * @param string $graph
     * @return Network
     */
    public function fromString($graph)
    {
        $graph = Graph::loadString($graph);

        return $this->fromGraph($graph);
    }

    /**
     * @param Graph $graph
     * @return Network
     */
    public function fromGraph(Graph $graph)
    {
        return Network::create($graph, $this->builder);
    }
}
