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

use ExtDirect\Annotations\Collections\DirectCollection;
use ExtDirect\Annotations\Interfaces\ClassInterface;
use ExtDirect\Annotations\Interfaces\MethodInterface;
use ExtDirect\Exceptions\ExtDirectException;
use ExtDirect\Utils\Keys;

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
     * @var null|string
     */
    protected $extNamespace = null;

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
    public function setExtNamespace($namespace)
    {
        $this->extNamespace = $namespace;
    }

    /**
     * Returns the ext js namespace
     *
     * @return string
     */
    public function getExtNamespace()
    {
        return $this->extNamespace;
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
     * Builds ExtDirect Header
     *
     * @example Ext.ns('Ext.app'); Ext.app.REMOTING_API = {
     *
     * @return string
     * @throws ExtDirectException
     */
    protected function buildHeader()
    {
        if ($this->getExtNamespace() === null) {
            throw new ExtDirectException("Ext js Namespace not set");
        }

        // Example: 'Ext.ns("Ext.app"); Ext.app.REMOTING_API = ';
        $var = 'Ext.ns("'.$this->getNameSpace().'"); '.$this->getNameSpace() . "." . Keys::EXT_HEADER . ' = ';

        return $var;
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
     * Generates complete ext api response as array
     *
     * @return array
     */
    protected function generateApi()
    {
        $api = array();
        $api["url"] = $this->getUrl();
        $api["type"] = "remoting";

        $actionsArray = array();

        /** @var DirectCollection $actions */
        $actions = $this->getActions();

        /** @var ClassInterface $class */
        foreach ($actions as $class) {
            $methodArray = array();
            /** @var MethodInterface $method */
            foreach ($class->getMethods() as $method) {
                $methodArray[] = array("name" => $method->getAnnotatedName(), "len" => $method->getLen());
            }
            $actionsArray[$class->getAnnotatedName()] = $methodArray;
        }

        $api["actions"] = $actionsArray;

        return $api;
    }

    /**
     * Returns a array containing ext api response
     *
     * @return bool|void
     */
    public function getApiAsArray()
    {
        if ($this->useCache()) {

            if ($this->getExtCache()->isApiCached()) {
                return $this->getExtCache()->getApi();
            }
        }

        $api = $this->generateApi();

        if ($this->useCache()) {
            $this->getExtCache()->cacheApi($api);
        }

        return $api;
    }

    /**
     * Returns ext api as json string
     *
     * @return string
     */
    public function getApi()
    {
        $header = $this->buildHeader();
        return $header . json_encode($this->getApiAsArray());
    }

    /**
     * Sets the ext js webapp namespace
     *
     * @param string $namespace the extjs webapp namespace
     *
     * @return void
     */
    public function setNameSpace($namespace)
    {
        $this->extNamespace = $namespace;
    }

    /**
     * Returns the ext js webapp namespace
     *
     * @return string
     */
    public function getNameSpace()
    {
        return $this->extNamespace;
    }
}
