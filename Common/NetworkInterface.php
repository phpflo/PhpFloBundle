<?php
/*
 * This file is part of the asm\phpflo-bundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\PhpFloBundle\Common;

use PhpFlo\ComponentInterface;
use PhpFlo\Graph;
use PhpFlo\SocketInterface;

/**
 * Interface NetworkInterface
 *
 * @package Asm\PhpFloBundle\Common
 * @author Marc Aschmann <maschmann@gmail.com>
 */
interface NetworkInterface
{
    /**
     * @return bool|\DateInterval
     */
    public function uptime();

    /**
     * @param array $node
     * @return NetworkInterface
     */
    public function addNode(array $node);

    /**
     * @param array $node
     * @return NetworkInterface
     */
    public function removeNode(array $node);

    /**
     * @param string $id
     * @return mixed|null
     */
    public function getNode($id);

    /**
     * @return null|Graph
     */
    public function getGraph();

    /**
     * @param array $edge
     * @return NetworkInterface
     */
    public function addEdge(array $edge);

    /**
     * @param array $edge
     * @return NetworkInterface
     */
    public function removeEdge(array $edge);

    /**
     * @param array $initializer
     * @return NetworkInterface
     */
    public function addInitial(array $initializer);

    /**
     * @param Graph $graph
     * @param RegistryInterface $registry
     * @return NetworkInterface
     */
    public static function create(Graph $graph, RegistryInterface $registry);
}
