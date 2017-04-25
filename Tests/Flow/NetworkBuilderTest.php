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

use PhpFlo\Common\NetworkInterface;
use PhpFlo\Core\Graph;
use PhpFlo\PhpFloBundle\Common\BuilderInterface;
use PhpFlo\PhpFloBundle\Flow\NetworkBuilder;
use PhpFlo\PhpFloBundle\Test\TestCase;
use org\bovigo\vfs\vfsStream;

/**
 * Class NetworkBuilderTest
 *
 * @package PhpFlo\PhpFloBundle\Tests\Flow
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class NetworkBuilderTest extends TestCase
{
    public function testBasicFunctionality()
    {
        $network = $this->stub(NetworkInterface::class);
        $network->expects($this->any())->method('boot')->willReturn($network);
        $network->expects($this->any())->method('run')->willReturn($network);
        $network->expects($this->any())->method('shutdown')->willReturn($network);
        $network->expects($this->any())->method('hook')->willReturn($network);
        $network->expects($this->any())->method('getGraph')->willReturn(
            $this->stub(Graph::class)
        );

        $networkBuilder = new NetworkBuilder($network);
        $this->assertInstanceOf(BuilderInterface::class, $networkBuilder);
        $network = $networkBuilder->boot('flow/default_flow.fbp');
        $this->assertInstanceOf(NetworkInterface::class, $network);

        $network = $networkBuilder->hook(
            'test',
            'yadda',
            function () {
                return null;
            }
        );
        $network = $networkBuilder->run('some_data', 'someNode', 'somePort');
        $network = $networkBuilder->shutdown();

        $graph = $network->getGraph();
        $this->assertInstanceOf(Graph::class, $graph);
    }
}
