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

use PhpFlo\Graph;
use PhpFlo\Network;

/**
 * Class AbstractNetworkBuilder
 *
 * @package PhpFlo\PhpFloBundle\Flow
 * @author Marc Aschmann <maschmann@gmail.com>
 */
abstract class AbstractNetworkBuilder
{
    /**
     * @param string $fileName
     * @return Network
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
