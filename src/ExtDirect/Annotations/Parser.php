<?php

/**
 * ExtDirect\Annotations\Parser
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

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use ExtDirect\Annotations\Collections\DirectCollection;
use ExtDirect\Annotations\Collections\RemotableCollection;
use ExtDirect\Exceptions\ExtDirectException;
use ReflectionClass;

/**
 * class Parser
 *
 * @category  ExtDirect
 * @package   ExtDirect
 * @author    Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright 2015 Philipp Dittert
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License, version 3 (GPL-3.0)
 * @link      https://github.com/dittertp/ExtDirect
 */

class Parser
{
    /**
     * @var string
     */
    protected $nameSpace;

    /**
     * @var array
     */
    protected $allowedFileExtensions;

    /**
     * @var string
     */
    protected $path;

    /**
     * constructor
     */
    public function __construct()
    {
        // sets a array containing all allowed file extensions
        $this->allowedFileExtensions = array("php");
    }

    /**
     * sets the basic path which is used to scan after remotable classes/actions
     *
     * @param string $path base path
     *
     * @return void
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Returns the relative application path
     *
     * @return string
     */
    protected function getPath()
    {
        return $this->path;
    }

    /**
     * Parses application directory for remotable methods
     *
     * @return DirectCollection
     */
    public function run()
    {
        $list = $this->getClassList();

        $directCollection = new DirectCollection();

        foreach ($list as $class) {
            $cl = $this->processClass($class);
            if ($cl !== false) {
                $directCollection->add($cl);
            }
        }
        return $directCollection;
    }

    /**
     * checks if given class should be remotable
     *
     * @param string $class the class name to check
     *
     * @return bool|null|object
     * @throws ExtDirectException
     */
    protected function processClass($class)
    {
        if (!class_exists("\\".$class)) {
            throw new ExtDirectException(" '{$class}' does not exist!");
        }

        $annotationReader = new AnnotationReader();
        AnnotationRegistry::registerLoader('class_exists');

        $reflectionClass = new ReflectionClass($class);
        $classAnnotation = $annotationReader->getClassAnnotation($reflectionClass, "ExtDirect\Annotations\Direct");

        if ($classAnnotation instanceof \ExtDirect\Annotations\Direct) {
            $classAnnotation->setClassName($class);

            $methodCollection = new RemotableCollection();
            foreach ($reflectionClass->getMethods() as $reflectionMethod) {
                $methodAnnotation = $annotationReader->getMethodAnnotation($reflectionMethod, "ExtDirect\Annotations\Remotable");

                if ($methodAnnotation instanceof \ExtDirect\Annotations\Remotable) {
                    $methodAnnotation->setLen($reflectionMethod->getNumberOfRequiredParameters());
                    $methodAnnotation->setMethodName($reflectionMethod->getName());

                    $methodCollection->add($methodAnnotation);
                }
            }

            $classAnnotation->setMethods($methodCollection);

            return $classAnnotation;

        }
        return false;
    }

    /**
     * Returns a flat array containing all Classes which
     *
     * @return array
     */
    protected function getClassList()
    {
        return $this->scanDir($this->getPath());
    }

    /**
     * Returns a array containing all allowed file extensions
     *
     * @return array
     */
    protected function getAllowedFileExtensions()
    {
        return $this->allowedFileExtensions;
    }

    /**
     * method to scan directory
     *
     * @param string $dir dir to scan
     *
     * @return array
     */
    protected function scanDir($dir)
    {
        $result = array();
        $list = $this->scanDirExec($dir);

        foreach ($list as $element) {
            $elementPath = $dir . DIRECTORY_SEPARATOR . $element;

            if (is_file($elementPath)) {
                $fileInfo = pathinfo($element);
                if (in_array($fileInfo['extension'], $this->getAllowedFileExtensions())) {
                    $result[] = $this->getNameSpace() . "\\" . $fileInfo['filename'];
                }
            }
        }
        return $result;
    }

    /**
     * scans given directory
     *
     * @param string $dir the dir to scan
     *
     * @return array
     */
    protected function scanDirExec($dir)
    {
        return scandir($dir);
    }

    /**
     * Sets the application namespace
     *
     * @param string $nameSpace the application namespace
     *
     * @return void
     */
    public function setNameSpace($nameSpace)
    {
        $this->nameSpace = $nameSpace;
    }

    /**
     * Returns the application namespace
     *
     * @return string
     */
    protected function getNameSpace()
    {
        return $this->nameSpace;
    }
}
