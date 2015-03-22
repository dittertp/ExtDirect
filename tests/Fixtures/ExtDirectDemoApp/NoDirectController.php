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

class NoDirectController
{
    public function MethodOneAction() {
        return array("success" => true);
    }

    public function MethodTwoAction()
    {
        return array("success" => true);
    }

    public function init($var)
    {
        // example method which can called if you use "call" method on ExtDirect object
    }
}
