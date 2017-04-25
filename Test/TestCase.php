<?php
/*
 * This file is part of the phpflo/phpflo-bundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace PhpFlo\PhpFloBundle\Test;

use PhpFlo\Common\Test\TestUtilityTrait;

/**
 * Stub and mock helper.
 *
 * @package PhpFlo\PhpFloBundle\Test
 * @author Marc Aschmann <maschmann@gmail.com>
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    use TestUtilityTrait;
}
