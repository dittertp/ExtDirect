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

use ExtDirect\Annotations\Interfaces\ClassInterface;
use ExtDirect\Annotations\Interfaces\MethodInterface;
use ExtDirect\Exceptions\ExtDirectException;

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
     * @var string
     */
    protected $paramMethod;

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
     * array containing all methods and parameters to be called
     *
     * @return array
     */
    protected function getMethodCalls()
    {
        return $this->callMethods;
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
     * request execution
     *
     * @return void
     * @throws Exceptions\ExtDirectException
     */
    public function run()
    {
        $class = $this->getAnnotationClassForAction($this->getParameters()->getAction());

        $method = $this->getAnnotationMethodForMethod($class, $this->getParameters()->getMethod());

        $className = $class->getClassName();

        $methodName = $method->getMethodName();

        if (!class_exists($className)) {
            throw new ExtDirectException("Class '{$className}' could not be loaded");
        }

        $reflectionClass = new \ReflectionClass($className);
        $controllerInstance = $reflectionClass->newInstance();

        if (!$reflectionClass->hasMethod($methodName)) {
            throw new ExtDirectException("Method '{$methodName}' not available in class '{$className}'");
        }

        // postbody parameter injection
        $paramMethod = $this->getParamMethod();
        if (!method_exists($controllerInstance, $paramMethod)) {
            throw new ExtDirectException("Method '{$this->getParamMethod()}' not available in class '{$className}'");
        }
        $controllerInstance->$paramMethod($this->getParameters()->getData());

        foreach ($this->getMethodCalls() as $mName => $mParams) {
            if (!$reflectionClass->hasMethod($mName)) {
                throw new ExtDirectException("Method '{$mName}' not available in class '{$className}'");
            }

            call_user_func_array(array($controllerInstance, $mName), $mParams);
        }

        $reflectionMethod = $reflectionClass->getMethod($methodName);
        $result = $reflectionMethod->invoke($controllerInstance);

        $this->getResponse()->setResult($result);
    }

    /**
     * Returns matching Annotation class
     *
     * @param string $requestAction ext direct requested action(class)
     *
     * @return ClassInterface
     * @throws Exceptions\ExtDirectException
     */
    protected function getAnnotationClassForAction($requestAction)
    {
        $actions = $this->getActions();

        /** @var ClassInterface $action */
        foreach ($actions as $action) {
            if ($action->getAnnotatedName() === $requestAction) {
                return $action;
            }
        }

        throw new ExtDirectException("extjs direct name '{$requestAction}' does not exist'");
    }

    /**
     * Returns method class if request method was found in collection
     *
     * @param ClassInterface $class         the application class
     * @param string         $requestMethod the request method
     *
     * @return MethodInterface
     * @throws Exceptions\ExtDirectException
     */
    protected function getAnnotationMethodForMethod(ClassInterface $class, $requestMethod)
    {
        /** @var MethodInterface $method */
        foreach ($class->getMethods() as $method) {
            if ($method->getAnnotatedName() === $requestMethod) {
                return $method;
            }
        }

        throw new ExtDirectException("extjs method name '{$requestMethod}' does not exist'");
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
}
