<?php

/**
 * ExtDirect\AbstractExtDirect
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

namespace ExtDirect;

use ExtDirect\Cache\ExtCache;
use ExtDirect\Request\Parameters;

/**
 * class AbstractExtDirect
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

abstract class AbstractExtDirect
{

    /**
     * @var string
     */
    protected $appNamespace;

    /**
     * @var string
     */
    const CACHE_KEY = "extDirectCache";

    /**
     * @var \ExtDirect\Cache\ExtCache
     */
    protected $extCache;

    /**
     * @var boolean
     */
    protected $useCache;

    /**
     * @var Parameters
     */
    protected $requestParameters;

    /**
     * constructor
     *
     * @param bool $useCache value if cache should used
     */
    public function __construct($useCache = true)
    {
        $this->setCacheState($useCache);
        $this->extCache = new ExtCache(self::CACHE_KEY);
    }

    /**
     * Sets value if cache should be used or not
     *
     * @param boolean $useCache the cache state
     *
     * @return void
     */
    protected function setCacheState($useCache)
    {
        if (is_bool($useCache)) {
            $this->useCache = $useCache;
        } else {
            error_log("ExtDirect: useCache not boolean - enabling cache by default");
            $this->useCache = true;
        }
    }

    /**
     * returns boolean cache state
     *
     * @return boolean
     */
    protected function useCache()
    {
        return $this->useCache;
    }

    /**
     * Returns ext js cache instance
     *
     * @return ExtCache
     */
    protected function getExtCache()
    {
        return $this->extCache;
    }

    /**
     * Returns request parameters instance
     *
     * @return Parameters
     */
    public function getParameters()
    {
        return $this->requestParameters;
    }

    /**
     * injects the request parameters
     *
     * @param Parameters $parameters the request parameters interface
     *
     * @return void
     */
    public function injectParameters(Parameters $parameters)
    {
        $this->requestParameters = $parameters;
    }

    /**
     * Sets the target application namespace
     *
     * @param string $namespace the basic namespace to target classes
     *
     * @return void
     */
    public function setAppNamespace($namespace)
    {
        $this->appNamespace = $namespace;
    }

    /**
     * Returns the basic application namespace
     *
     * @return string
     */
    protected function getAppNamespace()
    {
        return $this->appNamespace;
    }

    public function getActions()
    {
        if ($this->useCache()) {

        }

    }
}
