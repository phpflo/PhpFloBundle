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

use PhpFlo\PhpFloBundle\Flow\NetworkBuilder;
use PhpFlo\PhpFloBundle\Test\FlowTestCase;
use org\bovigo\vfs\vfsStream;

class NetworkBuilderTest extends FlowTestCase
{
    private $file;

    private $defaultFlow = <<< EOF
ReadFile(ReadFile) out -> in SplitbyLines(SplitStr)
ReadFile(ReadFile) error -> in Display(Output)
SplitbyLines(SplitStr) out -> in CountLines(Counter)
CountLines(Counter) count -> in Display(Output)
EOF;


    public function testInstance()
    {
        $registry = $this->stub('PhpFlo\Common\ComponentRegistryInterface');
        $networkBuilder = new NetworkBuilder($registry, '/');

        $this->assertInstanceOf('PhpFlo\PhpFloBundle\Flow\NetworkBuilder', $networkBuilder);
    }

    public function testLoadConfigs()
    {
        $registry = $this->stub('PhpFlo\Common\ComponentRegistryInterface');
        $file = $this->createFile('app/config/flow/default_flow.fbp', $this->defaultFlow);
        $networkBuilder = new NetworkBuilder($registry, 'vfs://root/test');

    }

    private function createFile($name, $content)
    {
        $root = vfsStream::setup();
        $this->file = vfsStream::newFile($name)->at($root);
        $this->file->setContent($content);

        return $this->file->url();
    }
}
