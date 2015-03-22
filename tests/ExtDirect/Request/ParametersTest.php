<?php

namespace ExtDirect\Request;

use ExtDirect\Exceptions\ExtDirectException;

class ParametersTest extends \PHPUnit_Framework_TestCase
{

    public function testSetAction()
    {
        $action = "FirstDemo";

        $parameters = new Parameters();
        $parameters->setAction($action);

        $this->assertEquals($action, $parameters->getAction());
    }

    public function testSetMethod()
    {
        $method = "List";

        $parameters = new Parameters();
        $parameters->setMethod($method);

        $this->assertEquals($method, $parameters->getMethod());
    }

    public function testSetType()
    {
        $type = "rpc";

        $parameters = new Parameters();
        $parameters->setType($type);

        $this->assertEquals($type, $parameters->getType());
    }

    public function testSetTid()
    {
        $tid = 123;

        $parameters = new Parameters();
        $parameters->setTid($tid);

        $this->assertEquals($tid, $parameters->getTid());
    }

    public function testSetData()
    {
        $data = array("key" => "value");

        $parameters = new Parameters();
        $parameters->setData($data);

        $this->assertEquals($data, $parameters->getData());
    }

    public function testSetParameters()
    {
        $request = array();
        $request['type'] = "rpc";
        $request['tid'] = 1;
        $request['action'] = "DemoApp";
        $request['method'] = "getTree";
        $request['data'] = array("demoKey"=>"demoValue");

        $parameters = new Parameters();
        $parameters->setParameters($request);

    }

    /**
     * * @expectedException \ExtDirect\Exceptions\ExtDirectException
     */
    public function testSetParametersMissionParameter()
    {
        $request = array();
        $request['type'] = "rpc";
        $request['tid'] = 1;
        $request['method'] = "getTree";
        $request['data'] = array("demoKey"=>"demoValue");

        $parameters = new Parameters();
        $parameters->setParameters($request);

    }

    /**
     * * @expectedException \ExtDirect\Exceptions\ExtDirectException
     */
    public function testSetParametersNotImplementParameter()
    {
        $parameters = $this->getMockBuilder('ExtDirect\Request\Parameters')
            ->setMethods(array('getRequiredParameters'))
            ->getMock();
        $parameters->expects($this->any())->method('getRequiredParameters')
            ->will($this->returnValue(array("type", "tid", "action", "method", "data", "dummyParameter")));

        $request = array();
        $request['type'] = "rpc";
        $request['tid'] = 1;
        $request['action'] = "DemoApp";
        $request['method'] = "getTree";
        $request['data'] = array("demoKey"=>"demoValue");

        $parameters->setParameters($request);

    }


}