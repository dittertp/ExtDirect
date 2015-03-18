<?php

/**
 * ExtDirect\Cache\ExtCache
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

namespace ExtDirect\Cache;

use ExtDirect\Exceptions\ExtDirectException;
use ExtDirect\Annotations\Collections\DirectCollection;
use ExtDirect\Utils\Keys;

/**
 * class ExtCache
 *
 * @category  ExtDirect
 * @package   ExtDirect
 * @author    Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright 2015 Philipp Dittert
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License, version 3 (GPL-3.0)
 * @link      https://github.com/dittertp/ExtDirect
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
     * Returns ext api as array
     *
     * @return array
     */
    public function getApi()
    {
        $api = $this->get(Keys::EXT_API);
        if (is_array($api)) {
            return $api;
        }
        error_log("api cache was not a array");
    }

    /**
     * Checks if api is cached
     *
     * @return bool
     */
    public function isApiCached()
    {
        // if action array is cached return true
        if ($this->get(Keys::EXT_API)) {
            return true;
        }
        return false;
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
     * Checks if actions are cached
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
     * @param string $key   the cache category (array key)
     * @param mixed  $value the value to be cached
     *
     * @return void
     */
    protected function set($key, $value)
    {
        $cache = apc_fetch($this->getKey());

        $cache[$key] = $value;

        apc_store($this->getKey(), $cache);
    }

    /**
     * Returns array containing cached list of classes and actions which are remotable
     *
     * @return bool
     */
    public function getActions()
    {
        $result = $this->get(Keys::EXT_ACTION);
        if (is_string($result)) {
            return unserialize($result);
        }
        error_log("cached actions not a string");
        return false;
    }

    /**
     * persists list of actions in cache
     *
     * @param DirectCollection $collection the actions which should be cached
     *
     * @return void
     */
    public function cacheActions(DirectCollection $collection)
    {
        $serializedCollection = serialize($collection);

        $this->set(Keys::EXT_ACTION, $serializedCollection);
    }

    /**
     * caches generated ext api
     *
     * @param array $api the api as array
     *
     * @return void
     */
    public function cacheApi(array $api)
    {
        $this->set(Keys::EXT_API, $api);
    }
}
