<?php
/*
 * This file is part of the asm/phpflo-bundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Flow;

use Asm\PhpFloBundle\Flow\Network;
use PhpFlo\Graph;

/**
 * Class NetworkTest
 *
 * @package Tests\Flow
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class NetworkTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        // no interface for mocking available, constructor needs argument
        $graph = new Graph('test');//$this->getMockBuilder('\PhpFlo\Graph')->getMock();
        $registry = $this->getMockBuilder('\Asm\PhpFloBundle\Common\RegistryInterface')->getMock();

        $network = Network::create($graph, $registry);

        $this->assertInstanceOf('\Asm\PhpFloBundle\Flow\Network', $network);
    }

    private function createNetwork()
    {
        $graph = $graph = new Graph('test');
        $registry = $this->getMockBuilder('\Asm\PhpFloBundle\Common\RegistryInterface')->getMock();

        $network = new Network($graph, $registry);
    }
}
