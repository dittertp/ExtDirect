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
     * @Remotable(name = "getTree")
     */
    public function meopMoep() {

    }

    /**
     * @Remotable(name = "getTree4")
     */
    public function tutut($hans, $dampf, $schuch)
    {

    }
}
