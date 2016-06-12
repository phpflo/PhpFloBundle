<?php
/*
 * This file is part of the asm\phpflo-bundle package.
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
use Doctrine\DBAL\Exception\InvalidArgumentException;
use PhpFlo\Graph;
use Symfony\Component\Finder\Finder;

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
     * @Todo maybe find a cached solution for that?
     *
     * @param string $fileName
     * @return NetworkInterface
     * @throws InvalidArgumentException
     */
    public function fromFile($fileName)
    {
        $fileUri = $this->root . '/' . ltrim($fileName, '/');

        if (file_exists($fileUri)) {
            $graph = file_get_contents($fileUri);
        } else {
            throw new InvalidArgumentException('Could not find file ' . $fileUri);
        }

        return $this->fromString($graph);
    }

    /**
     * @param string $graph
     * @return NetworkInterface
     */
    public function fromString($graph)
    {
        $graph = Graph::loadString($graph);

        return $this->fromGraph($graph);
    }

    /**
     * @param Graph $graph
     * @return NetworkInterface
     */
    public function fromGraph(Graph $graph)
    {
        return Network::create($graph, $this->registry);
    }
}
