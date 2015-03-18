<?php

/**
 * ExtDirect\Annotations\Interfaces\ClassInterface
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to version 3 of the GPL license,
 * that is bundled with this package in the file LICENSE, and is
 * available online at http://www.gnu.org/licenses/gpl.txt
 *
 * PHP version 5
 *
 * @category  ExtDirect
 * @package   ExtDirect
 * @author    Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright 2015 Philipp Dittert
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License, version 3 (GPL-3.0)
 * @link      https://github.com/dittertp/ExtDirect
 */

namespace ExtDirect\Annotations\Interfaces;

use ExtDirect\Annotations\Collections\RemotableCollection;

/**
 * class ClassInterface
 *
 * @category  ExtDirect
 * @package   ExtDirect
 * @author    Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright 2015 Philipp Dittert
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License, version 3 (GPL-3.0)
 * @link      https://github.com/dittertp/ExtDirect
 */

interface ClassInterface
{
    /**
     * Returns annotated name
     *
     * @return mixed
     */
    public function getAnnotatedName();

    /**
     * Returns original class name
     *
     * @return mixed
     */
    public function getClassName();

    /**
     * Sets the original class name
     *
     * @param string $className the class name
     *
     * @return mixed
     */
    public function setClassName($className);

    /**
     * Sets a collection containing all remotable methods
     *
     * @param RemotableCollection $methods the method collection
     *
     * @return mixed
     */
    public function setMethods(RemotableCollection $methods);

    /**
     * Returns collection containing all remotable methods
     *
     * @return RemotableCollection
     */
    public function getMethods();
}
