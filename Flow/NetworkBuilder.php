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

use PhpFlo\Common\NetworkInterface;
use PhpFlo\Exception\FlowException;
use PhpFlo\Exception\InvalidDefinitionException;
use PhpFlo\Exception\InvalidTypeException;
use PhpFlo\Graph;
use PhpFlo\Network;
use PhpFlo\PhpFloBundle\Common\BuilderInterface;
use PhpFlo\Common\ComponentBuilderInterface;

/**
 * Class Builder
 *
 * @package PhpFlo\PhpFloBundle\Flow
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class NetworkBuilder implements BuilderInterface
{
    /**
     * @var NetworkInterface
     */
    private $network;

    /**
     * @param NetworkInterface $network
     */
    public function __construct(NetworkInterface $network)
    {
        $this->network = $network;
    }

    /**
     * Add a flow definition as Graph object or definition file/string
     * and initialize the network processes/connections
     *
     * @param mixed $graph
     * @return NetworkInterface
     * @throws InvalidDefinitionException
     */
    public function boot($graph)
    {
        return $this->network->boot($graph);
    }

    /**
     * Add initialization data
     *
     * @param mixed $data
     * @param string $node
     * @param string $port
     * @return NetworkInterface
     * @throws FlowException
     */
    public function run($data, $node, $port)
    {
        return $this->network->run($data, $node, $port);
    }

    /**
     * Cleanup network state after runs.
     *
     * @return NetworkInterface
     */
    public function shutdown()
    {
        return $this->network->shutdown();
    }

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
    public function hook($event, $alias, \Closure $closure)
    {
        return $this->network->hook($event, $alias, $closure);
    }
}
