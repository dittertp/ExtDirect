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

use ExtDirect\Exceptions\ExtDirectException;
use ExtDirect\Utils\Keys;

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

    /**
     * Checks if something is cached
     *
     * @return bool
     */
    public function isCached()
    {
        // if action array is cached return true
        if ($this->get(Keys::EXT_ACTION)) {
            return true;
        }
        return false;
    }

    /**
     * Returns a part of cached array
     *
     * @param string $key cache category (action, namespace...)
     *
     * @return bool
     */
    protected function get($key)
    {
        $cache = apc_fetch($this->getKey());
        if (!is_array($cache)) {
            return false;
        } else {
            if (isset($cache[$key])) {
                return $cache[$key];
            }
            return false;
        }
    }

    /**
     * persists given value in cache
     *
     * @param string $key the cache category (array key)
     * @param mixed  $value the value to be cached
     *
     * @return void
     */
    protected function set($key, $value)
    {
        $cache = apc_fetch($this->getKey());

        $cache[Keys::EXT_ACTION] = $value;

        apc_store($this->getKey(), $cache);
    }

    /**
     * Returns array containing cached list of classes and actions which are remotable
     *
     * @return bool
     */
    public function getActions()
    {
        return $this->get(Keys::EXT_ACTION);
    }

    /**
     * persists list of actions in cache
     *
     * @param string $actions the actions which should be cached
     *
     * @return void
     * @throws \ExtDirect\Exceptions\ExtDirectException
     */
    public function cacheActions($actions)
    {
        if (!is_array($actions)) {
            throw new ExtDirectException("unable to cache a non array value as actions");
        }
        $this->set(Keys::EXT_ACTION, $actions);
    }


}
