<?php
/*
 * This file is part of the asm\phpflo-bundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\PhpFlowBundle\Common;

use PhpFlo\ComponentInterface;

/**
 * Class AbstractComponent
 *
 * @package Mps\Core\Flow\Component
 * @author Marc Aschmann <maschmann@gmail.com>
 */
abstract class AbstractComponent implements ReferenceInterface, ComponentInterface
{
    /**
     * @var array
     */
    public $inPorts;

    /**
     * @var array
     */
    public $outPorts;

    /**
     * @var string
     */
    protected $description;
}
