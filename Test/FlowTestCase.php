<?php
/*
 * This file is part of the phpflo/phpflo-bundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PhpFlo\PhpFloBundle\Test;

/**
 * Stub and mock helper.
 *
 * @package Test
 * @author Marc Aschmann <maschmann@gmail.com>
 */
abstract class FlowTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Will create a stub with several methods and defined return values.
     * definition:
     * [
     *   'myMethod' => 'somevalue',
     *   'myOtherMethod' => $callback,
     *   'anotherMethod' => function ($x) use ($y) {},
     * ]
     *
     * @param string $class
     * @param array $methods
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function stub($class, array $methods = [])
    {
        $stub = $this->getMockBuilder($class)
            ->disableOriginalConstructor()
            ->getMock();

        foreach ($methods as $method => $value) {
            if (is_callable($value)) {
                $stub->expects($this->any())->method($method)->willReturnCallback($value);
            } else {
                $stub->expects($this->any())->method($method)->willReturn($value);
            }
        }

        return $stub;
    }
}
