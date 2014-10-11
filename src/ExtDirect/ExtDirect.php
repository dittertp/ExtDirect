<?php

/**
 * ExtDirect\ExtDirect
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

use ExtDirect\Collections\ResponseCollection;
use ExtDirect\Exceptions\ExtDirectException;
use ExtDirect\Request\Parameters;

/**
 * class ExtDirect
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

class ExtDirect
{

    /**
     * @var ExtDirectApi
     */
    protected $api;

    /**
     * @var boolean
     */
    protected $useCache;

    /**
     * @var string
     */
    protected $applicationPath;

    /**
     * @var array
     */
    protected $callMethods = array();

    /**
     * @var string
     */
    protected $paramMethod;

    /**
     * @var ExtDirectResponse
     */
    protected $response;

    /**
     * constructor
     *
     * @param bool $useCache value if cache should used
     */
    public function __construct($useCache = true)
    {
        $this->setCacheState($useCache);
    }

    /**
     * Sets Application path
     *
     * @param string $applicationPath the application path
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
    protected function getApplicationPath()
    {
        return $this->applicationPath;
    }

    /**
     * Sets a application method and parameters to be called after construction
     *
     * @param string $key   application method to call
     * @param array  $value application values as array
     *
     * @return void
     */
    public function call($key, array $value)
    {
        $this->callMethods[$key] = $value;
    }

    /**
     * Set name of method which should get request data (postbody / "data" key in request array)
     *
     * @param string $paramMethod method name for parameter injection
     *
     * @return void
     */
    public function setParamMethod($paramMethod)
    {
        $this->paramMethod = $paramMethod;
    }

    /**
     * Returns method which should get request data
     *
     * @return string
     */
    protected function getParamMethod()
    {
        return $this->paramMethod;
    }

    /**
     * Returns a array containing all methods to be called after application class initializing
     *
     * @return array
     */
    protected function getMethodsToCall()
    {
        return $this->callMethods;
    }

    /**
     * request processing
     *
     * @param array $request the ext direct request as array
     *
     * @return void
     */
    public function processRequest(array $request)
    {
        $responseCollection = new ResponseCollection();
        $result = array();
        try {
            if ($this->isBatchedRequest($request)) {
                foreach ($request as $singleRequest) {
                    try {
                        $responseCollection->add($this->process($singleRequest));
                    } catch (ExtDirectException $e) {
                           error_log("ExtDirect: error in batch request - {$e->getMessage()}");
                    }
                }
            } else {
                try {
                    $responseCollection->add($this->process($request));
                } catch (ExtDirectException $e) {
                    error_log("ExtDirect: error in request - {$e->getMessage()}");
                }
            }
            $this->setResponse($responseCollection);
        } catch (\Exception $e) {
            error_log($e->getMessage());
        }
    }

    /**
     * process a single ext direct request
     *
     * @param array $requestParams the ext direct request as array
     *
     * @return array
     */
    protected function process(array $requestParams)
    {
        $request = new ExtDirectRequest($this->useCache());
        $response = new ExtDirectResponse();
        $requestParameters = new Parameters();
        // parameter validation here
        $request->setApplicationPath($this->getApplicationPath());
        $requestParameters->setParameters($requestParams);

        // inject parameters instance into request and response object to get access to all relevant params
        $request->injectParameters($requestParameters);
        $response->injectParameters($requestParameters);

        $request->injectResponse($response);

        $request->setParamMethod($this->getParamMethod());
        $request->setMethodCalls($this->getMethodsToCall());

        $request->run();

        //return $response->asArray();
        return $response;
    }

    /**
     * Sets response instance
     *
     * @param ResponseCollection $response the response instance
     *
     * @return void
     */
    protected function setResponse(ResponseCollection $response)
    {
        $this->response = $response;
    }

    /**
     * Returns response instance
     *
     * @return ResponseCollection
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * checks if request is batched (multiple requests in one call)
     *
     * @param array $request the ext direct request as array
     *
     * @return bool
     */
    protected function isBatchedRequest($request)
    {
        // if "action" is not available it has to be multiple Requests
        if (!isset($request["action"])) {
            return true;
        }
        return false;
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
     * Returns ExtDirectApi instance
     *
     * @return ExtDirectApi
     */
    public function getApi()
    {
        if ($this->api === null) {
            $this->api = new ExtDirectApi($this->useCache());
        }
        return $this->api;
    }
}
