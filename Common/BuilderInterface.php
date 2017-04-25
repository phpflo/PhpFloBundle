<?php
/*
 * This file is part of the phpflo\phpflo-bundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace PhpFlo\PhpFloBundle\Common;

use PhpFlo\Common\NetworkInterface;
use PhpFlo\Exception\FlowException;
use PhpFlo\Exception\InvalidDefinitionException;
use PhpFlo\Exception\InvalidTypeException;
use PhpFlo\Graph;

/**
 * Interface BuilderInterface
 *
 * @package PhpFlo\PhpFloBundle\Common
 * @author Marc Aschmann <maschmann@gmail.com>
 */
interface BuilderInterface
{

    /**
     * Add a flow definition as Graph object or definition file/string
     * and initialize the network processes/connections
     *
     * @param mixed $graph
     * @return NetworkInterface
     * @throws InvalidDefinitionException
     */
    public function boot($graph) : NetworkInterface;

    /**
     * Add initialization data
     *
     * @param mixed $data
     * @param string $node
     * @param string $port
     * @return NetworkInterface
     * @throws FlowException
     */
    public function run($data, string $node, string $port) : NetworkInterface;

    /**
     * Cleanup network state after runs.
     *
     * @return NetworkInterface
     */
    public function shutdown() : NetworkInterface;

    /**
     * Add a closure to an event
     *
     * Accepted events are connect, disconnect and data
     * Closures will be given the
     *
     * @param string $event
     * @param string $alias
     * @param \Closure $closure
     * @throws FlowException
     * @throws InvalidTypeException
     * @return NetworkInterface
     */
    public function hook(string $event, string $alias, \Closure $closure);
}
