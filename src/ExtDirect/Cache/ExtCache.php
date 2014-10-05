<?php

/**
 * ExtDirect\Cache\ExtCache
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

namespace ExtDirect\Cache;

/**
 * class ExtCache
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

class ExtCache
{
    /**
     * @var string
     */
    protected $key;

    /**
     * constructor
     *
     * @param string $key the cache key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * checks if action exists in api
     *
     * @param string $action the ext direct request action
     *
     * @return bool
     */
    public function ActionExists($action)
    {
        $api = $this->getApi();
    }

    protected function getApi()
    {
        $api = apc_fetch($this->getKey());
        if (!is_array($api)) {

        }
    }

    /**
     * Returns cache key
     *
     * @return string
     */
    protected function getKey()
    {
        return $this->key;
    }
} 