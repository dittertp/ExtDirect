<?php

/**
 * ExtDirect\Collections\ResponseCollection
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

use ExtDirect\ExtDirectResponse;

/**
 * class ResponseCollection
 *
 * @category  ExtDirect
 * @package   ExtDirect
 * @author    Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright 2015 Philipp Dittert
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License, version 3 (GPL-3.0)
 * @link      https://github.com/dittertp/ExtDirect
 */

class ResponseCollection extends Collection implements \IteratorAggregate
{
    /**
     * Add's a ext response instance to the collection
     *
     * @param ExtDirectResponse $response the response instance
     *
     * @return void
     */
    public function add(ExtDirectResponse $response)
    {
            $this->collection[] = $response;
    }

    /**
     * Returns ext direct response as array
     *
     * @return array
     */
    public function asArray()
    {

        $result = array();

        /** @var ExtDirectResponse $response */
        foreach ($this->collection as $response) {
            $result[] = $response->getResultAsArray();
        }

        return $result;
    }

    /**
     * Returns response as json
     *
     * @return string
     */
    public function asJson()
    {
        return json_encode($this->asArray());
    }
}
