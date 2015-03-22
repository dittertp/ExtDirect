<?php

namespace ExtDirect\Annotations\Collections;

use ExtDirect\Annotations\Remotable;

class RemotableCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd()
    {
        $method = new Remotable();
        $method->name = "DummyAction";

        $collection = new RemotableCollection();

        $collection->add($method);

    }

    /**
     * * @expectedException \ExtDirect\Exceptions\ExtDirectException
     */
    public function testAddNotUnique()
    {
        $method = new Remotable();
        $method->name = "DummyAction";

        $collection = new RemotableCollection();

        $collection->add($method);
        $collection->add($method);

    }
}