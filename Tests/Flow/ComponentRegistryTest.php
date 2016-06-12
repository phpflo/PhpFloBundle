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


use Asm\PhpFloBundle\Flow\ComponentRegistry;
use PhpFlo\ComponentInterface;

/**
 * Class ComponentRegistryTest
 *
 * @package Tests\Flow
 * @author Marc Aschmann <maschmann@gmail.com>
 */
class ComponentRegistryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetReference()
    {
        $componentMock = $this->createMock('\PhpFlo\ComponentInterface');
        $registry = $this->createRegistry();
        $registry->addReference($componentMock, 'component_1');

        $component = $registry->getReference('component_1');
        $this->assertInstanceOf('\PhpFlo\ComponentInterface', $component, 'addReference failed');
    }

    public function testGetReferences()
    {
        $componentMock = $this->createMock('\PhpFlo\ComponentInterface');
        $registry = $this->createRegistry();
        $registry
            ->addReference($componentMock, 'component_1')
            ->addReference($componentMock, 'component_2');

        $references = $registry->getReferences();

        $this->assertTrue(is_array($references));
        $this->assertArrayHasKey('component_1', $references, 'registry key for component_1 not found');
        $this->assertArrayHasKey('component_2', $references, 'registry key for component_2 not found');
    }

    public function testRemoveReference()
    {
        $componentMock = $this->createMock('\PhpFlo\ComponentInterface');
        $registry = $this->createRegistry();
        $registry->addReference($componentMock, 'component_1');
        $component = $registry->getReference('component_1');
        $this->assertInstanceOf('\PhpFlo\ComponentInterface', $component, 'addReference failed');
        $registry->removeReference('component_1');
        $result = $registry->getReference('component_1');
        $this->assertFalse($result, 'reference was not removed');
    }

    private function createRegistry()
    {
        return new ComponentRegistry();
    }
}
