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
use ExtDirect\Exceptions\ExtDirectApplicationException;

/**
 * @Direct(name="FirstDemo")
 */
class FirstDemoController
{
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
        // dummy method for injecting post parameters
    }

    /**
     * @Remotable(name = "throwException")
     */
    public function throwExceptionAction()
    {
        $action = array("action" => "logout");
        throw new ExtDirectApplicationException("dummy ext direct application exception", 403, null, $action);
    }

    /**
     * @Remotable(name = "throwExceptionNoResponse")
     */
    public function throwExceptionAlternativeAction()
    {
        throw new ExtDirectApplicationException("dummy ext direct application exception", 403, null, "");
    }
}
