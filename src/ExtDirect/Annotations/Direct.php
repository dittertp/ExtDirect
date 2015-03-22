<?php

/**
 * ExtDirect\Annotations\Direct
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to version 3 of the GPL license,
 * that is bundled with this package in the file LICENSE, and is
 * available online at http://www.gnu.org/licenses/gpl.txt
 *
 * PHP version 5
 *
 * @category  ExtDirect
 * @package   ExtDirect
 * @author    Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright 2015 Philipp Dittert
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License, version 3 (GPL-3.0)
 * @link      https://github.com/dittertp/ExtDirect
 */

namespace ExtDirect\Annotations;

use ExtDirect\Annotations\Collections\RemotableCollection;
use ExtDirect\Annotations\Interfaces\ClassInterface;
use ExtDirect\Annotations\Interfaces\MethodInterface;

/**
 * class Direct
 *
 * @category  ExtDirect
 * @package   ExtDirect
 * @author    Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright 2015 Philipp Dittert
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License, version 3 (GPL-3.0)
 * @link      https://github.com/dittertp/ExtDirect
 * @Annotation
 */

class Direct implements ClassInterface
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    protected $className;

    /**
     * @var RemotableCollection
     */
    protected $methods;

    /**
     * Returns annotated name
     *
     * @return mixed
     */
    public function getAnnotatedName()
    {
        return $this->name;
    }

    /**
     * Returns original class name
     *
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * Sets the original class name
     *
     * @param string $className the class name
     *
     * @return mixed
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }

    /**
     * Sets a collection containing all remote able methods
     *
     * @param RemotableCollection $methods the method collection
     *
     * @return mixed
     */
    public function setMethods(RemotableCollection $methods)
    {
        $this->methods = $methods;
    }

    /**
     * Returns collection containing all remotable methods
     *
     * @return RemotableCollection
     */
    public function getMethods()
    {
        return $this->methods;
    }
}
