<?php

/**
 * ExtDirect\Collections\CollectionIterator
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
 * class CollectionIterator
 *
 * @category  ExtDirect
 * @package   ExtDirect
 * @author    Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright 2015 Philipp Dittert
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License, version 3 (GPL-3.0)
 * @link      https://github.com/dittertp/ExtDirect
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
