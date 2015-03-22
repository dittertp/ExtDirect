<?php

/**
 * ExtDirect\Annotations\Collections\RemotableCollection
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
use ExtDirect\Annotations\Interfaces\MethodInterface;
use ExtDirect\Exceptions\ExtDirectException;

/**
 * class RemotableCollection
 *
 * @category  ExtDirect
 * @package   ExtDirect
 * @author    Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright 2015 Philipp Dittert
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License, version 3 (GPL-3.0)
 * @link      https://github.com/dittertp/ExtDirect
 */

class RemotableCollection extends Collection implements \IteratorAggregate
{
    /**
     * Adds a remote able instance to the collection
     *
     * @param MethodInterface $method the remote able instance
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
