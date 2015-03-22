<?php

namespace ExtDirect;

use ExtDirect\Request\Parameters;

class ExtDirectRequestTest extends \PHPUnit_Framework_TestCase
{
    protected $demoAppPath = "tests/Fixtures/ExtDirectDemoApp";

    protected $demoAppNameSpace = "ExtDirectDemoApp";

    public function testRun()
    {

        $requestParams = array();
        $requestParams['type'] = "rpc";
        $requestParams['tid'] = 1;
        $requestParams['action'] = "FirstDemo";
        $requestParams['method'] = "getTree";
        $requestParams['data'] = array("demoKey"=>"demoValue");


        $request = new ExtDirectRequest(false, $this->demoAppPath, $this->demoAppNameSpace);
        // parameter validation here
        $response = new ExtDirectResponse();
        $requestParameters = new Parameters();
        $requestParameters->setParameters($requestParams);
        // inject parameters instance into request and response object to get access to all relevant params
        $request->injectParameters($requestParameters);
        $response->injectParameters($requestParameters);

        $request->injectResponse($response);

        $request->setParamMethod("setParams");
        $request->setMethodCalls(array("init" => array("dummy")));

        $request->run();
    }

    /**
     * @expectedException \ExtDirect\Exceptions\ExtDirectException
     */
    public function testRunInvalidAction()
    {

        $requestParams = array();
        $requestParams['type'] = "rpc";
        $requestParams['tid'] = 1;
        $requestParams['action'] = "NotExistentDemoClass";
        $requestParams['method'] = "getTree";
        $requestParams['data'] = array("demoKey"=>"demoValue");


        $request = new ExtDirectRequest(false, $this->demoAppPath, $this->demoAppNameSpace);
        // parameter validation here
        $response = new ExtDirectResponse();
        $requestParameters = new Parameters();
        $requestParameters->setParameters($requestParams);
        // inject parameters instance into request and response object to get access to all relevant params
        $request->injectParameters($requestParameters);
        $response->injectParameters($requestParameters);

        $request->injectResponse($response);

        $request->setParamMethod("setParams");
        $request->setMethodCalls(array("init" => array("dummy")));

        $request->run();
    }

    /**
     * @expectedException \ExtDirect\Exceptions\ExtDirectException
     */
    public function testRunInvalidMethod()
    {

        $requestParams = array();
        $requestParams['type'] = "rpc";
        $requestParams['tid'] = 1;
        $requestParams['action'] = "FirstDemo";
        $requestParams['method'] = "nonExistentMethod";
        $requestParams['data'] = array("demoKey"=>"demoValue");


        $request = new ExtDirectRequest(false, $this->demoAppPath, $this->demoAppNameSpace);
        // parameter validation here
        $response = new ExtDirectResponse();
        $requestParameters = new Parameters();
        $requestParameters->setParameters($requestParams);
        // inject parameters instance into request and response object to get access to all relevant params
        $request->injectParameters($requestParameters);
        $response->injectParameters($requestParameters);

        $request->injectResponse($response);

        $request->setParamMethod("setParams");
        $request->setMethodCalls(array("init" => array("dummy")));

        $request->run();
    }

    /**
     * @expectedException \ExtDirect\Exceptions\ExtDirectException
     */
    public function testRunInvalidSetParamsMethod()
    {

        $requestParams = array();
        $requestParams['type'] = "rpc";
        $requestParams['tid'] = 1;
        $requestParams['action'] = "FirstDemo";
        $requestParams['method'] = "getTree";
        $requestParams['data'] = array("demoKey"=>"demoValue");


        $request = new ExtDirectRequest(false, $this->demoAppPath, $this->demoAppNameSpace);
        // parameter validation here
        $response = new ExtDirectResponse();
        $requestParameters = new Parameters();
        $requestParameters->setParameters($requestParams);
        // inject parameters instance into request and response object to get access to all relevant params
        $request->injectParameters($requestParameters);
        $response->injectParameters($requestParameters);

        $request->injectResponse($response);

        $request->setParamMethod("invalidParamMethod");
        $request->setMethodCalls(array("init" => array("dummy")));

        $request->run();
    }

    /**
     * @expectedException \ExtDirect\Exceptions\ExtDirectException
     */
    public function testRunInvalidGenericMethodCallMethod()
    {

        $requestParams = array();
        $requestParams['type'] = "rpc";
        $requestParams['tid'] = 1;
        $requestParams['action'] = "FirstDemo";
        $requestParams['method'] = "getTree";
        $requestParams['data'] = array("demoKey"=>"demoValue");


        $request = new ExtDirectRequest(false, $this->demoAppPath, $this->demoAppNameSpace);
        // parameter validation here
        $response = new ExtDirectResponse();
        $requestParameters = new Parameters();
        $requestParameters->setParameters($requestParams);
        // inject parameters instance into request and response object to get access to all relevant params
        $request->injectParameters($requestParameters);
        $response->injectParameters($requestParameters);

        $request->injectResponse($response);

        $request->setParamMethod("setParams");
        $request->setMethodCalls(array("invalidMethod" => array("dummy")));

        $request->run();
    }
}