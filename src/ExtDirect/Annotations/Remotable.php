<?php

/**
 * ExtDirect\Annotations\Remotable
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

namespace ExtDirect\Annotations;

use ExtDirect\Annotations\Interfaces\MethodInterface;

/**
 * class Remotable
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 * @Annotation
 */
class Remotable implements MethodInterface
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var mixed
     */
    public $len = null;

    /**
     * @var string
     */
    protected $methodName;

    /**
     * Sets amount of method parameters if not set already
     *
     * @param integer $number number of required method parameters
     *
     * @return void
     */
    public function setLenIfNotSet($number)
    {
        if ($this->len === null) {
            $this->len = $number;
        }
    }

    /**
     * Sets the original method name
     *
     * @param string $method the original method name
     *
     * @return void
     */
    public function setMethodName($method)
    {
        $this->methodName = $method;
    }

    /**
     * Returns original method name
     *
     * @return string
     */
    public function getMethodName()
    {
        return $this->methodName;
    }

    /**
     * Returns remotable name
     *
     * @return string
     */
    public function getAnnotatedName()
    {
        return $this->name;
    }

    /**
     * Returns amount of required method parameters
     *
     * @return int|mixed
     */
    public function getLen()
    {
        if ($this->len === null) {
            $len = 0;
        } else {
            $len = $this->len;
        }

        return $len;
    }
}
