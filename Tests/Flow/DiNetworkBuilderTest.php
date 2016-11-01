<?php
/*
 * This file is part of the <package> package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpFlo\PhpFloBundle\Tests\Flow;

use PhpFlo\Component;
use PhpFlo\PhpFloBundle\Flow\DiNetworkBuilder;
use PhpFlo\PhpFloBundle\Test\FlowTestCase;
use org\bovigo\vfs\vfsStream;


class DiNetworkBuilderTest extends FlowTestCase
{
    private $file;
    private $defaultFlow = <<< EOF
ReadFile(ReadFile) out -> in SplitbyLines(SplitStr)
CountLines(Counter) count -> in Display(Output)
EOF;

    public function testLoadConfigs()
    {
        $elements = [
            'ReadFile' => ['out' => ['out'], 'in' => [],],
            'SplitStr' => ['in' => ['in'], 'out' => [],],
            'Counter' => ['out' => ['count'], 'in' => [], ],
            'Output' => ['in' => ['in'], 'out' => [],]
        ];
        $components = [];
        foreach ($elements as $name => $element) {
            $components[$name] = new Component();
            foreach ($element['in'] as $port) {
                $components[$name]->inPorts()->add($port, []);
            }

            foreach ($element['out'] as $port) {
                $components[$name]->outPorts()->add($port, []);
            }
        }

        $componentsCb = function ($name) use ($components) {
            return $components[$name];
        };

        $container = $this->stub(
            '\Symfony\Component\DependencyInjection\ContainerInterface',
            [
                'get' => $componentsCb,
            ]
        );
        $file = $this->createFile('app/config/flow/default_flow.fbp', $this->defaultFlow);

        $networkBuilder = new DiNetworkBuilder($container, 'vfs://root/test');
        $this->assertInstanceOf('PhpFlo\PhpFloBundle\Flow\DiNetworkBuilder', $networkBuilder);

        $network = $networkBuilder->fromFile('flow/default_flow.fbp');
        $this->assertInstanceOf('PhpFlo\Network', $network);

        $graph = $network->getGraph();
        $this->assertInstanceOf('PhpFlo\Graph', $graph);

        $this->assertEquals($this->defaultFlow, $graph->toFbp());
    }

    private function createFile($name, $content)
    {
        $root = vfsStream::setup();
        $this->file = vfsStream::newFile($name)->at($root);
        $this->file->setContent($content);

        return $this->file->url();
    }
}
