<?php
/*
 * This file is part of the asm\phpflo-bundle package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asm\PhpFloBundle\Common;

use Asm\Data\Data;
use PhpFlo\ComponentInterface;

/**
 * Class AbstractRegistry
 *
 * @package Asm\PhpFloBundle\Common
 * @author Marc Aschmann <maschmann@gmail.com>
 */
abstract class AbstractRegistry extends Data
{
    /**
     * @inheritdoc
     */
    public function addReference(ComponentInterface $reference, $alias, array $options = [])
    {
        $this->set(
            $alias,
            $reference
        );

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function removeReference($reference)
    {
        $this->remove($reference);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getReference($alias)
    {
        return $this->get($alias);
    }

    /**
     * @inheritdoc
     */
    public function getReferences()
    {
        return $this->toArray();
    }
}
