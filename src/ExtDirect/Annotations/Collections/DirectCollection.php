<?php

/**
 * ExtDirect\Annotations\Collections\DirectCollection
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

namespace ExtDirect\Annotations\Collections;

use ExtDirect\Collections\Collection;
use ExtDirect\Annotations\Interfaces\ClassInterface;
use ExtDirect\Exceptions\ExtDirectException;

/**
 * class DirectCollection
 *
 * @category  ExtDirect
 * @package   ExtDirect
 * @author    Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright 2015 Philipp Dittert
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License, version 3 (GPL-3.0)
 * @link      https://github.com/dittertp/ExtDirect
 */

class DirectCollection extends Collection implements \IteratorAggregate
{
    /**
     * Adds a direct instance to the collection
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
