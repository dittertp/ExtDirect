<?php

namespace ExtDirect\Annotations;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;

class ParserTest extends \PHPUnit_Framework_TestCase
{

    protected function getDefaultClassList()
    {
        return array(
            'ExtDirectDemoApp\FirstDemoController',
            'ExtDirectDemoApp\NoDirectController',
            'ExtDirectDemoApp\SecondDemoController'
        );
    }

    protected static function getMethod($name) {
        $class = new \ReflectionClass('ExtDirect\Annotations\Parser');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    public function testSetNameSpace() {
        $path = "Application\\path\\dummy";
        $getNameSpace = self::getMethod('getNameSpace');

        $parser = new Parser();
        $parser->setNameSpace($path);
        $this->assertEquals($path, $getNameSpace->invokeArgs($parser, array()));
    }

    public function testSetPath() {
        $path = "Application/path/dummy";
        $getPath = self::getMethod('getPath');

        $parser = new Parser();
        $parser->setPath($path);
        $getPath->invokeArgs($parser, array());
        $this->assertEquals($path, $getPath->invokeArgs($parser, array()));
    }

    public function testScanDir()
    {
        // $expected =  array ('\\FirstDemoController', '\\SecondDemoController');
        $expected = $this->getDefaultClassList();

        $scanDir = self::getMethod('scanDir');

        $parser = new Parser();
        $parser->setPath("tests/Fixtures/ExtDirectDemoApp");
        $parser->setNameSpace("ExtDirectDemoApp");
        $result = $scanDir->invokeArgs($parser, array("tests/Fixtures/ExtDirectDemoApp"));

        $this->assertEquals($expected, $result);
    }

    public function testGetClassList()
    {
        //$expected = array('ExtDirectDemoApp\FirstDemoController', 'ExtDirectDemoApp\SecondDemoController');
        $expected = $this->getDefaultClassList();

        $getClassList = self::getMethod('getClassList');

        $parser = new Parser();
        $parser->setPath("tests/Fixtures/ExtDirectDemoApp");
        $parser->setNameSpace("ExtDirectDemoApp");

        $result = $getClassList->invokeArgs($parser, array());

        $this->assertEquals($expected, $result);
    }

    public function testProcessClass()
    {
        $processClass = self::getMethod('processClass');

        $parser = new Parser();
        $parser->setPath("tests/Fixtures/ExtDirectDemoApp");
        $parser->setNameSpace("ExtDirectDemoApp");

        $result = $processClass->invokeArgs($parser, array('ExtDirectDemoApp\FirstDemoController'));

        // error_log(var_export($result,true));
    }

    /**
     * * @expectedException \ExtDirect\Exceptions\ExtDirectException
     */
    public function testProcessClassNotExistingClass()
    {
        $processClass = self::getMethod('processClass');

        $parser = new Parser();
        $parser->setPath("tests/Fixtures/ExtDirectDemoApp");
        $parser->setNameSpace("ExtDirectDemoApp");

        $result = $processClass->invokeArgs($parser, array('ExtDirectDemoApp\NotExistingDemoController'));

    }

    public function testProcessClassNoDirectClass()
    {
        $processClass = self::getMethod('processClass');

        $parser = new Parser();
        $parser->setPath("tests/Fixtures/ExtDirectDemoApp");
        $parser->setNameSpace("ExtDirectDemoApp");

        $result = $processClass->invokeArgs($parser, array('ExtDirectDemoApp\NoDirectController'));
        $this->assertFalse($result);
    }

    public function testrun()
    {
        $expected = array('ExtDirectDemoApp\FirstDemoController', 'ExtDirectDemoApp\SecondDemoController');

        $getClassList = self::getMethod('getClassList');

        $parser = new Parser();
        $parser->setPath("tests/Fixtures/ExtDirectDemoApp");
        $parser->setNameSpace("ExtDirectDemoApp");

        $parser->run();

        // $this->assertEquals($expected, $result);
    }

}
