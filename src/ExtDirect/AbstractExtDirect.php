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
use ExtDirect\Annotations\Parser;
use ExtDirect\Utils\Keys;

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
    protected $applicationNameSpace;

    /**
     * @var string
     */
    protected $applicationPath;

    /**
     * @var string
     */
    protected $appNamespace;

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
        $this->extCache = new ExtCache(Keys::CACHE_KEY);
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
     * Returns a array containing all remotable actions
     *
     * @return bool|void
     */
    public function getActions()
    {
        if ($this->useCache()) {
            if ($this->getExtCache()->isCached()) {
                return $this->getExtCache()->getActions();
            }
        }

        $actions = $this->generateActions();

        if ($this->useCache()) {
            $this->getExtCache()->cacheActions($actions);
        }

        return $actions;
    }

    /**
     * Generates DirectCollection containing all remotable methods
     *
     * @return Annotations\Collections\DirectCollection
     */
    protected function generateActions()
    {
        $parser = new Parser();
        $parser->setPath($this->getApplicationPath());
        $parser->setNameSpace($this->getApplicationNameSpace());

        $list = $parser->run();

        return $list;
    }

    /**
     * Sets the application path
     *
     * @param string $applicationPath path to application
     *
     * @return void
     */
    public function setApplicationPath($applicationPath)
    {
        $this->applicationPath = $applicationPath;
    }

    /**
     * Returns the application path
     *
     * @return string
     */
    public function getApplicationPath()
    {
        return $this->applicationPath;
    }

    /**
     * Sets the application namespace
     *
     * @param string $applicationNameSpace application's namespace
     *
     * @return void
     */
    public function setApplicationNameSpace($applicationNameSpace)
    {
        $this->applicationNameSpace = $applicationNameSpace;
    }

    /**
     * Returns the application namespace
     *
     * @return string
     */
    public function getApplicationNameSpace()
    {
        return $this->applicationNameSpace;
    }
}
