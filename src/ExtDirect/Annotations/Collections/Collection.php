<?php

/**
 * ExtDirect\Annotations\Collections\Collection
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

/**
 * class Collection
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

class Collection
{
    /**
     * Holds the entities
     *
     * @var array
     */
    protected $collection = array();

    /**
     * Returns the collection iterator
     *
     * @return CollectionIterator
     */
    public function getIterator()
    {
        return new CollectionIterator($this->collection);
    }

    /**
     * checks if annotated name does not exist already
     *
     * @param mixed $instance the direct instance
     *
     * @return bool
     */
    protected function isUnique($instance)
    {
        foreach ($this->getCollection() as $entry) {

            if ($entry->getAnnotatedName() === $instance->getAnnotatedName()) {
                return false;
            }
        }

        return true;
    }

    /**
     * Returns the collection array
     *
     * @return array
     */
    protected function getCollection()
    {
        return $this->collection;
    }
}
