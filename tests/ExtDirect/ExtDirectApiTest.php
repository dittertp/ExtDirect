<?php

namespace ExtDirect;

class ExtDirectApiTest extends \PHPUnit_Framework_TestCase
{
    protected $demoAppPath = "tests/Fixtures/ExtDirectDemoApp";

    protected $demoAppNameSpace = "ExtDirectDemoApp";

    protected static function getMethod($name)
    {
        $class = new \ReflectionClass('ExtDirect\ExtDirectApi');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }


    public function testSetExtNamespace()
    {
        $api = new ExtDirectApi(false);
        $api->setExtNamespace("Ext.app");

        $this->assertEquals("Ext.app", $api->getExtNamespace());
    }

    public function testSetUrl()
    {
        $api = new ExtDirectApi(false);
        $api->setUrl("/direct.php");

        $this->assertEquals("/direct.php", $api->getUrl());
    }

    public function testSetNameSpace()
    {
        $api = new ExtDirectApi(false);
        $api->setNameSpace($this->demoAppNameSpace);

        $this->assertEquals($this->demoAppNameSpace, $api->getNameSpace());
    }

    public function testBuildHeader()
    {
        $expected = 'Ext.ns("Ext.demoApp"); Ext.demoApp.REMOTING_API = ';

        $api = new ExtDirectApi(false);
        $api->setExtNamespace("Ext.demoApp");

        $buildHeader = self::getMethod('buildHeader');


        $this->assertEquals($expected, $buildHeader->invokeArgs($api, array()));
    }

    /**
     * * @expectedException \ExtDirect\Exceptions\ExtDirectException
     */
    public function testBuildHeaderNoExtNameSpace()
    {
        $expected = 'Ext.ns("Ext.demoApp"); Ext.demoApp.REMOTING_API = ';

        $api = new ExtDirectApi(false);
        $buildHeader = self::getMethod('buildHeader');
        $buildHeader->invokeArgs($api, array());
    }



    public function testGenerateApi()
    {

        $api = new ExtDirectApi(false, $this->demoAppPath, $this->demoAppNameSpace);
        $api->setExtNamespace("Ext.demoApp");
        $api->setUrl("/direct.php");

        $generateApi = self::getMethod('generateApi');

        $generateApi->invokeArgs($api, array());

        //@TODO check result
    }

    public function testGetApiAsArray()
    {

        $api = new ExtDirectApi(false, $this->demoAppPath, $this->demoAppNameSpace);
        $api->setExtNamespace("Ext.demoApp");
        $api->setUrl("/direct.php");
        $api->getApiAsArray();

        //@TODO check result
    }

    public function testGetApiAsArrayUseCache()
    {

        $api = new ExtDirectApi(true, $this->demoAppPath, $this->demoAppNameSpace);
        $api->setExtNamespace("Ext.demoApp");
        $api->setUrl("/direct.php");
        $api->getApiAsArray();

        //@TODO check result
    }

    public function testGetApiAsArrayReadFromCache()
    {

        $api = new ExtDirectApi(true, $this->demoAppPath, $this->demoAppNameSpace);
        $api->setExtNamespace("Ext.demoApp");
        $api->setUrl("/direct.php");
        $api->getApiAsArray();

        // read api a second time to use cached result
        $api->getApiAsArray();

        //@TODO check result
    }

    public function testGetApi()
    {

        $api = new ExtDirectApi(true, $this->demoAppPath, $this->demoAppNameSpace);
        $api->setExtNamespace("Ext.demoApp");
        $api->setUrl("/direct.php");
        $api->getApi();

        //@TODO check result
    }

}