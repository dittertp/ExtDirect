<?php

/**
 * ExtDirect\ExtDirectRequest
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
 * class ExtDirectRequest
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

class ExtDirectRequest extends AbstractExtDirect
{
    /**
     * @var ExtDirectResponse;
     */
    protected $response;

    /**
     * @var array
     */
    protected $callMethods;

    /**
     * Returns ext direct response object
     *
     * @return ExtDirectResponse
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Sets a array containing all methods to be called for instantiated target class
     *
     * @param array $methodToCall containing all methods (with parameters) which should be called on target method
     *
     * @return void
     */
    public function setMethodCalls(array $methodToCall)
    {
        $this->callMethods = $methodToCall;
    }

    /**
     * inject response instance
     *
     * @param ExtDirectResponse $response the response instance
     *
     * @return void
     */
    public function injectResponse(ExtDirectResponse $response)
    {
        $this->response = $response;
    }

    /**
     * executing the request
     *
     * @return void
     */
    public function run()
    {
        /*
        // Build Path to our applicationcontroller
        $controller = $this->getParameters()->getAction() . 'Controller';
        $action = $this->getParameters()->getMethod();

        $className = $this->getApplicationPath() . $controller;

        $reflectionClass = new \ReflectionClass($className);
        $controllerInstance = $reflectionClass->newInstance();

        if ($reflectionClass->hasMethod($action . 'Action')) {

            $controllerInstance->injectRequest($this->getRequest());
            $controllerInstance->init();
            // inject Request Parameters
            $controllerInstance->setParams($this->getParameters()->getData());

            $reflectionMethod = $reflectionClass->getMethod($action . 'Action');
            $result = $reflectionMethod->invoke($controllerInstance);
        }
        $this->getResponse()->setData($result);
        */

        $this->getResponse()->setResult(array("ads"=>"asd"));
    }
}
