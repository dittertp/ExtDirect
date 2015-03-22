<?php

namespace ExtDirect\Annotations;

class DirectTest extends \PHPUnit_Framework_TestCase
{

    public function testSetClassName()
    {
        $direct = new Direct();

        $direct->setClassName("Dummy");

        $this->assertEquals("Dummy", $direct->getClassName());
    }

}