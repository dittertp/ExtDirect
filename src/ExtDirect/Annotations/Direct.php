<?php

/**
 * ExtDirect\Annotations\Direct
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

use ExtDirect\Annotations\Collections\RemotableCollection;
use ExtDirect\Annotations\Interfaces\ClassInterface;
use ExtDirect\Annotations\Interfaces\MethodInterface;

/**
 * class Direct
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 * @Annotation
 */

class Direct implements ClassInterface
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    protected $className;

    /**
     * @var RemotableCollection
     */
    protected $methods;

    /**
     * Returns annotated name
     *
     * @return mixed
     */
    public function getAnnotatedName()
    {
        return $this->name;
    }

    /**
     * Returns original class name
     *
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Sets the original class name
     *
     * @param string $className the class name
     *
     * @return mixed
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }

    /**
     * Sets a collection containing all remotable methods
     *
     * @param RemotableCollection $methods the method collection
     *
     * @return mixed
     */
    public function setMethods(RemotableCollection $methods)
    {
        $this->methods = $methods;
    }

    /**
     * Returns collection containing all remotable methods
     *
     * @return RemotableCollection
     */
    public function getMethods()
    {
        return $this->methods;
    }
}
