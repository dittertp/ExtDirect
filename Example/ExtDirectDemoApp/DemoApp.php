<?php
/**
 * Created by PhpStorm.
 * User: dittertp
 * Date: 10.10.14
 * Time: 10:44
 */

namespace ExtDirectDemoApp;

use ExtDirect\Annotations\Direct;
use ExtDirect\Annotations\Remotable;

/**
 * @Direct(name="DemoApp")
 */
class DemoApp
{

    public function __construct()
    {
        //$direct = new Direct();
    }

    /**
     * @Remotable(name = "getTree")
     */
    public function treeAction() {
        return array("success"=>true);
    }

    /**
     * @Remotable(name = "getList")
     */
    public function listAction()
    {
        return array("success"=>true);
    }

    public function init($var)
    {
        // example method which can called if you use "call" method on ExtDirect object
    }

    public function setParams($params)
    {
    }
}
