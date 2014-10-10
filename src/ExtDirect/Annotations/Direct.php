<?php
/**
 * Created by PhpStorm.
 * User: dittertp
 * Date: 10.10.14
 * Time: 09:54
 */

namespace ExtDirect\Annotations;

/**
 *@Annotation
 */
class Direct
{
    public $name;

    protected $className;

    protected $methods;

    public function getAnnotatedName()
    {
        return $this->name;
    }

    public function getClassName()
    {
        return $this->className;
    }

    public function setClassName($className)
    {
        $this->className = $className;
    }

    public function setMethods($methods)
    {
        $this->methods = $methods;
    }
}
