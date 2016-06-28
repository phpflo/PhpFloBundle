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

use PhpFlo\Common\ComponentInterface;

/**
 * Base interface for managers (registry pattern)
 *
 * @package Asm\PhpFloBundle\Common
 * @author Marc Aschmann <maschmann@gmail.com>
 */
interface RegistryInterface
{
    /**
     * Add a reference to internal storage.
     *
     * @param ComponentInterface $reference
     * @param string $alias name of the reference
     * @param array $options additional options for the reference
     * @return $this
     */
    public function addReference(ComponentInterface $reference, $alias, array $options = []);

    /**
     * Remove reference from List
     *
     * @param string $reference
     * @return $this
     */
    public function removeReference($reference);

    /**
     *
     * Get a specific Reference.
     *
     * @param string $alias
     * @return ReferenceInterface|bool
     */
    public function getReference($alias);

    /**
     * Returns array of all References
     *
     * @return array
     */
    public function getReferences();
}
