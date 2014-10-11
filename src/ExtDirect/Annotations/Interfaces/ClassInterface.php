<?php

/**
 * ExtDirect\Annotations\Interfaces\ClassInterface
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

use ExtDirect\Annotations\Collections\RemotableCollection;

/**
 * class ClassInterface
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
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
