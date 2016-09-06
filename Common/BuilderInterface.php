<?php
/*
 * This file is part of the asm\phpflo-bundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PhpFlo\PhpFloBundle\Common;

use PhpFlo\Graph;

/**
 * Interface BuilderInterface
 *
 * @package PhpFlo\PhpFloBundle\Common
 * @author Marc Aschmann <maschmann@gmail.com>
 */
interface BuilderInterface
{
    /**
     * @param string $fileName
     * @return NetworkInterface
     */
    public function fromFile($fileName);

    /**
     * @param string $graph
     * @return NetworkInterface
     */
    public function fromString($graph);

    /**
     * @param Graph $graph
     * @return NetworkInterface
     */
    public function fromGraph(Graph $graph);
}
