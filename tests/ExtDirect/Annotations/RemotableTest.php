<?php

namespace ExtDirect\Annotations;

class RemotableTest extends \PHPUnit_Framework_TestCase
{

    public function testSetMethodName()
    {
        $remotable = new Remotable();

        $remotable->setMethodName("Dummy");

        $this->assertEquals("Dummy", $remotable->getMethodName());
    }

    public function testGetLen()
    {
        $remotable = new Remotable();

        $this->assertEquals(0, $remotable->getLen());
    }
}