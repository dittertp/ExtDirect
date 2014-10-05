<?php

/**
 * ExtDirect\ExtDirectApi
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

/**
 * class ExtDirectApi
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

class ExtDirectApi extends AbstractExtDirect
{
    /**
     * @var string
     */
    protected $namespace;

    /**
     * @var array
     */
    protected $action;

    /**
     * @var string
     */
    protected $url;

    /**
     * Sets the web applications namespace
     *
     * @param string $namespace the ext js web app namespace
     *
     * @return void
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * Returns the ext js namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Sets the ext direct url
     *
     * @param string $url the ext direct url
     *
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Returns ext direct url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
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
}
