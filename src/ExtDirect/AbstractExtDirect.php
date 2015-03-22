<?php

/**
 * ExtDirect\AbstractExtDirect
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

namespace ExtDirect;

use ExtDirect\Cache\ExtCache;
use ExtDirect\Request\Parameters;
use ExtDirect\Annotations\Parser;
use ExtDirect\Utils\Keys;

/**
 * class AbstractExtDirect
 *
 * @category  ExtDirect
 * @package   ExtDirect
 * @author    Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright 2015 Philipp Dittert
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License, version 3 (GPL-3.0)
 * @link      https://github.com/dittertp/ExtDirect
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
     * @param bool   $useCache             value if cache should used
     * @param string $applicationPath      the application path
     * @param string $applicationNameSpace the application namespace
     */
    public function __construct($useCache = true, $applicationPath = "", $applicationNameSpace = "")
    {
        $this->setCacheState($useCache);
        $this->extCache = new ExtCache(Keys::CACHE_KEY);

        $this->setApplicationPath($applicationPath);
        $this->setApplicationNameSpace($applicationNameSpace);
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
        $this->useCache = $useCache;
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
     * Returns a array containing all remote able actions
     *
     * @return array
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
     * Generates DirectCollection containing all remote able methods
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
