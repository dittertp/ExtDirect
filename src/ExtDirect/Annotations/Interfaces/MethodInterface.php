<?php

/**
 * ExtDirect\Annotations\Interfaces\MethodInterface
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

/**
 * class MethodInterface
 *
 * @category  ExtDirect
 * @package   ExtDirect
 * @author    Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright 2015 Philipp Dittert
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License, version 3 (GPL-3.0)
 * @link      https://github.com/dittertp/ExtDirect
 */

interface MethodInterface
{
    /**
     * Sets amount of method parameters if not set already
     *
     * @param integer $number number of required method parameters
     *
     * @return void
     */
    public function setLenIfNotSet($number);

    /**
     * Sets the original method name
     *
     * @param string $method the original method name
     *
     * @return void
     */
    public function setMethodName($method);

    /**
     * Returns original method name
     *
     * @return string
     */
    public function getMethodName();

    /**
     * Returns remotable name
     *
     * @return string
     */
    public function getAnnotatedName();

    /**
     * Returns amount of required method parameters
     *
     * @return int|mixed
     */
    public function getLen();
}
