<?php

/**
 * ExtDirect\Annotations\Collections\DirectCollection
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

namespace ExtDirect\Annotations\Collections;

use ExtDirect\Annotations\Direct;
use ExtDirect\Annotations\Interfaces\ClassInterface;
use ExtDirect\Exceptions\ExtDirectException;

/**
 * class DirectCollection
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

class DirectCollection extends Collection implements \IteratorAggregate
{
    /**
     * Add's a direct instance to the collection
     *
     * @param ClassInterface $class the direct instance
     *
     * @return void
     * @throws ExtDirectException
     */
    public function add(ClassInterface $class)
    {
        if ($this->isUnique($class)) {
            $this->collection[] = $class;
        } else {
            throw new ExtDirectException("Direct classname {$class->getAnnotatedName()} already exists, but have to be unique");
        }
    }
}
