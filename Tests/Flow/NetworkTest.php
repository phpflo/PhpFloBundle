<?php
/*
 * This file is part of the phpflo/phpflo-bundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhpFlo\PhpFloBundle\Tests\Flow;

use PhpFlo\Network;
use PhpFlo\Graph;
use PhpFlo\PhpFloBundle\Test\FlowTestCase;

/**
 * Class NetworkTest
 *
 * @package Tests\Flow
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class NetworkTest extends FlowTestCase
{
    public function testCreate()
    {
        $graph = $this->stub('\PhpFlo\Graph');
        $graph->nodes = [];
        $graph->edges = [];
        $graph->initializers = [];
        $builder = $this->stub('\PhpFlo\Common\ComponentBuilderInterface');
        $network = Network::create($graph, $builder);

        $this->assertInstanceOf('\PhpFlo\Network', $network);
    }
}
