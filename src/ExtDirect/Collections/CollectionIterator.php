<?php

/**
 * ExtDirect\Collections\CollectionIterator
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

namespace ExtDirect\Collections;

/**
 * class CollectionIterator
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

class CollectionIterator implements \Iterator
{
    /**
     * Hold's the values to iterate
     *
     * @var array
     */
    private $var = array();

    /**
     * initialize iterator
     *
     * @param array $array list of entities
     */
    public function __construct(array $array)
    {
        if (is_array($array)) {
            $this->var = $array;
        }
    }

    /**
     * Reset's iterator to first key
     *
     * @return void
     */
    public function rewind()
    {
        reset($this->var);
    }

    /**
     * Return's current value
     *
     * @return false|mixed|void
     */
    public function current()
    {
        $var = current($this->var);
        return $var;
    }

    /**
     * Return's key for value
     *
     * @return false|mixed|void
     */
    public function key()
    {
        $var = key($this->var);
        return $var;
    }

    /**
     * Return's next value
     *
     * @return mixed|void
     */
    public function next()
    {
        $var = next($this->var);
        return $var;
    }

    /**
     * Checks if current value exists
     *
     * @return bool
     */
    public function valid()
    {
        $var = $this->current() !== false;
        return $var;
    }
}
