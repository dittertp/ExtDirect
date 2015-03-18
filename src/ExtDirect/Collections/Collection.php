<?php

/**
 * ExtDirect\Collections\Collection
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

namespace ExtDirect\Collections;

/**
 * class Collection
 *
 * @category  ExtDirect
 * @package   ExtDirect
 * @author    Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright 2015 Philipp Dittert
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License, version 3 (GPL-3.0)
 * @link      https://github.com/dittertp/ExtDirect
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
