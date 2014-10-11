<?php

/**
 * ExtDirect\Annotations\Interfaces\MethodInterface
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

namespace ExtDirect\Annotations\Interfaces;

/**
 * class MethodInterface
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
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
