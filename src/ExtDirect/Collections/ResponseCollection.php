<?php

/**
 * ExtDirect\Collections\ResponseCollection
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

use ExtDirect\ExtDirectResponse;

/**
 * class ResponseCollection
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
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
}
