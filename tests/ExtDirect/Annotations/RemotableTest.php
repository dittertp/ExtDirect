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

    public function testSetLen()
    {
        $remotable = new Remotable();

        $remotable->setLen(1);

        $this->assertEquals(1, $remotable->getLen());
    }

    public function testGetLen()
    {
        $remotable = new Remotable();

        $this->assertEquals(0, $remotable->getLen());
    }

    /**
     * * @expectedException \ExtDirect\Exceptions\ExtDirectException
     */
    public function testSetLenStringExpectException()
    {
        $remotable = new Remotable();

        $remotable->setLen("invalid value");
    }

}