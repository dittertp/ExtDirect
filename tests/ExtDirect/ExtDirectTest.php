<?php

namespace ExtDirect;

use ExtDirect\Collections\ResponseCollection;

class ExtDirectTest extends \PHPUnit_Framework_TestCase
{
    protected $demoAppPath = "tests/Fixtures/ExtDirectDemoApp";

    protected $demoAppNameSpace = "ExtDirectDemoApp";

    protected static function getMethod($name) {
        $class = new \ReflectionClass('ExtDirect\ExtDirect');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    public function testSetApplicationPath()
    {
        $direct = new ExtDirect();
        $direct->setApplicationPath("Dummy");

        $this->assertEquals("Dummy", $direct->getApplicationPath());
    }

    public function testSetApplicationNameSpace()
    {
        $direct = new ExtDirect();
        $direct->setApplicationNameSpace("Dummy");

        $this->assertEquals("Dummy", $direct->getApplicationNameSpace());
    }

    public function testSetParamMethod()
    {
        $direct = new ExtDirect();
        $direct->setParamMethod("init");

        $getParamMethod = self::getMethod('getParamMethod');
        $this->assertEquals("init", $getParamMethod->invokeArgs($direct, array()));
    }

    public function testcall()
    {
        $result = array(
            "one" => array("param1", "param2"),
            "two" => array("param3", "param4")
        );

        $direct = new ExtDirect();
        $direct->call("one", array("param1", "param2"));
        $direct->call("two", array("param3", "param4"));

        $getMethodsToCall = self::getMethod('getMethodsToCall');
        $this->assertEquals($result, $getMethodsToCall->invokeArgs($direct, array()));
    }

    public function testUseCache()
    {
        $direct = new ExtDirect();
        $useCache = self::getMethod('useCache');
        $this->assertTrue($useCache->invokeArgs($direct, array()));
    }

    public function testDisableCache()
    {
        $direct = new ExtDirect(false);
        $useCache = self::getMethod('useCache');
        $this->assertFalse($useCache->invokeArgs($direct, array()));
    }

    public function testDisableCacheInvalidParam()
    {
        $direct = new ExtDirect("nein");
        $useCache = self::getMethod('useCache');
        $this->assertTrue($useCache->invokeArgs($direct, array()));
    }

    public function testgetApi()
    {
        $direct = new ExtDirect();
        $direct->setApplicationPath($this->demoAppPath);
        $direct->setApplicationNameSpace($this->demoAppNameSpace);



        $this->assertInstanceOf("ExtDirect\ExtDirectApi", $direct->getApi());
    }

    public function testGetResponse()
    {
        $direct = new ExtDirect();
        $responseCollection = new ResponseCollection();

        $setResponse = self::getMethod('setResponse');
        $setResponse->invokeArgs($direct, array($responseCollection));

        $this->assertEquals($responseCollection, $direct->getResponse());
    }

    public function testProcessRequestBatchedRequest()
    {
        $request1 = array();
        $request1['type'] = "rpc";
        $request1['tid'] = 1;
        $request1['action'] = "DemoApp";
        $request1['method'] = "getTree";
        $request1['data'] = array("demoKey"=>"demoValue");

        $request2 = array();
        $request2['type'] = "rpc";
        $request2['tid'] = 2;
        $request2['action'] = "DemoApp";
        $request2['method'] = "getList";
        $request2['data'] = array("demoKey"=>"demoValue");

        $request = array($request1, $request2);


        $direct = new ExtDirect();
        $direct->setApplicationPath($this->demoAppPath);
        $direct->setApplicationNameSpace($this->demoAppNameSpace);
        $direct->call("init", array("initparameter"));
        $direct->setParamMethod("setParams");

        $direct->processRequest($request);

        $result = $direct->getResponse()->asArray();


    }

    public function testProcessRequestSingleRequest()
    {
        $request = array();
        $request['type'] = "rpc";
        $request['tid'] = 1;
        $request['action'] = "DemoApp";
        $request['method'] = "getTree";
        $request['data'] = array("demoKey"=>"demoValue");

        $direct = new ExtDirect();
        $direct->setApplicationPath($this->demoAppPath);
        $direct->setApplicationNameSpace($this->demoAppNameSpace);
        $direct->call("init", array("initparameter"));
        $direct->setParamMethod("setParams");

        $direct->processRequest($request);

        $result = $direct->getResponse()->asArray();

    }


    public function testProcessRequestSingleRequestThrowApplicationExceptionWithResponse()
    {
        $request = array();
        $request['type'] = "rpc";
        $request['tid'] = 1;
        $request['action'] = "FirstDemo";
        $request['method'] = "throwException";
        $request['data'] = array("demoKey" => "demoValue");

        $direct = new ExtDirect();
        $direct->setApplicationPath($this->demoAppPath);
        $direct->setApplicationNameSpace($this->demoAppNameSpace);
        $direct->call("init", array("initparameter"));
        $direct->setParamMethod("setParams");

        $direct->processRequest($request);

        $result = $direct->getResponse()->asArray();
    }

    public function testProcessRequestSingleRequestThrowApplicationExceptionWithoutResponse()
    {
        $request = array();
        $request['type'] = "rpc";
        $request['tid'] = 1;
        $request['action'] = "FirstDemo";
        $request['method'] = "throwExceptionNoResponse";
        $request['data'] = array("demoKey" => "demoValue");

        $direct = new ExtDirect();
        $direct->setApplicationPath($this->demoAppPath);
        $direct->setApplicationNameSpace($this->demoAppNameSpace);
        $direct->call("init", array("initparameter"));
        $direct->setParamMethod("setParams");

        $direct->processRequest($request);

        $result = $direct->getResponse()->asArray();
    }



}