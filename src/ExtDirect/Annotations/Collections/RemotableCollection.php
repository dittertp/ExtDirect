<?php

/**
 * ExtDirect\Annotations\Collections\RemotableCollection
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

use ExtDirect\Annotations\Interfaces\MethodInterface;
use ExtDirect\Exceptions\ExtDirectException;

/**
 * class RemotableCollection
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

class RemotableCollection extends Collection implements \IteratorAggregate
{
    /**
     * Add's a remotable instance to the collection
     *
     * @param MethodInterface $method the remotable instance
     *
     * @return void
     * @throws ExtDirectException
     */
    public function add(MethodInterface $method)
    {
        if ($this->isUnique($method)) {
            $this->collection[] = $method;
        } else {
            throw new ExtDirectException("Remotable methodname {$method->getAnnotatedName()} already exists, but have to be unique");
        }
    }
}
