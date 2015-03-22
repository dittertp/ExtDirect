<?php


namespace ExtDirect\Annotations\Collections;

use ExtDirect\Annotations\Direct;

class DirectCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testAdd()
    {
        $method = new Direct();
        $method->name = "DummyAction";

        $collection = new DirectCollection();

        $collection->add($method);

    }

    /**
     * * @expectedException \ExtDirect\Exceptions\ExtDirectException
     */
    public function testAddNotUnique()
    {
        $method = new Direct();
        $method->name = "DummyAction";

        $collection = new DirectCollection();

        $collection->add($method);
        $collection->add($method);

    }
}
