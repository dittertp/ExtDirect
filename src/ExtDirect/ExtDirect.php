<?php

/**
 * ExtDirect\ExtDirect
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

use ExtDirect\Collections\ResponseCollection;
use ExtDirect\Exceptions\ExtDirectException;
use ExtDirect\Exceptions\ExtDirectApplicationException;
use ExtDirect\Request\Parameters;

/**
 * class ExtDirect
 *
 * @category  ExtDirect
 * @package   ExtDirect
 * @author    Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright 2015 Philipp Dittert
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License, version 3 (GPL-3.0)
 * @link      https://github.com/dittertp/ExtDirect
 */

class ExtDirect
{
    /**
     * @var string
     */
    protected $applicationNameSpace;

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
     * @var ResponseCollection
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
        if ($this->isBatchedRequest($request)) {
            foreach ($request as $singleRequest) {
                $responseCollection->add($this->process($singleRequest));
            }
        } else {
            $responseCollection->add($this->process($request));
        }
        $this->setResponse($responseCollection);
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
        $request = new ExtDirectRequest($this->useCache(), $this->getApplicationPath(), $this->getApplicationNameSpace());
        $response = new ExtDirectResponse();
        $requestParameters = new Parameters();

        try {
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

        } catch (ExtDirectApplicationException $e) {
            $result = $e->getResponse();

            if (!empty($result)) {
                $response->setResult(array("success" => false, "message" => $e->getMessage(), "actions" => $result));
            } else {
                $response->setResult(array("success" => false, "message" => $e->getMessage()));
            }

        } catch (\Exception $e) {
            $response->setResult(array("success" => false, "message" => $e->getMessage()));
        }

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
            // every invalid param would activate cache
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
            $this->api = new ExtDirectApi($this->useCache(), $this->getApplicationPath(), $this->getApplicationNameSpace());
        }
        return $this->api;
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
