<?php
/**
 * Created by PhpStorm.
 * User: dittertp
 * Date: 10.10.14
 * Time: 10:44
 */

namespace Application;

use ExtDirect\Annotations\Direct;
use ExtDirect\Annotations\Remotable;

/**
 * @Direct(name="DemoApp")
 * @Remotable(name = "getTree")
 */
class DemoApp
{

    public function __construct()
    {
        //$direct = new Direct();
    }

    /**
     * @Remotable(name = "getTree", len = 1)
     */
    public function meopMoep() {

    }

    /**
     * @Remotable(name = "getTreegb", len = 2)
     */
    public function tutut()
    {

    }

} 