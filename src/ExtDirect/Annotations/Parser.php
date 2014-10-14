<?php

/**
 * ExtDirect\Annotations\Parser
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

namespace ExtDirect\Annotations;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use ExtDirect\Annotations\Collections\DirectCollection;
use ExtDirect\Annotations\Collections\RemotableCollection;
use ReflectionClass;

/**
 * class Parser
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
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
     */
    protected function processClass($class)
    {
        if (!class_exists("\\".$class)) {
            error_log(" '{$class}' does not exist!");
        }

        $annotationReader = new AnnotationReader();
        AnnotationRegistry::registerLoader('class_exists');

        $reflectionClass = new ReflectionClass($class);
        $classAnnotation = $annotationReader->getClassAnnotation($reflectionClass, "ExtDirect\Annotations\Direct");

        if ($classAnnotation instanceof \ExtDirect\Annotations\Direct) {

            $classAnnotation->setClassName($class);

            // error_log(var_export($classAnnotation, true));

            $methodCollection = new RemotableCollection();
            foreach ($reflectionClass->getMethods() as $reflectionMethod) {

                $methodAnnotation = $annotationReader->getMethodAnnotation($reflectionMethod, "ExtDirect\Annotations\Remotable");

                if ($methodAnnotation instanceof \ExtDirect\Annotations\Remotable) {
                    $methodAnnotation->setLenIfNotSet($reflectionMethod->getNumberOfRequiredParameters());
                    $methodAnnotation->setMethodName($reflectionMethod->getName());

                    $methodCollection->add($methodAnnotation);

                    //error_log($reflectionMethod->getNumberOfRequiredParameters());
                    // error_log(var_export($methodAnnotation, true));
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
     * recursive method to scan directory
     * NOT USED AT THE MOMENT
     *
     * @param string $dir dir to scan
     *
     * @return array
     */
    protected function scanDirRecursive($dir)
    {
        $result = array();
        $dirResult = array();
        $list = scandir($dir);

        foreach ($list as $element) {

            $elementPath = $dir . DIRECTORY_SEPARATOR . $element;

            if (is_file($elementPath)) {
                $fileExtension = pathinfo($element, PATHINFO_EXTENSION);
                if (in_array($fileExtension, $this->getAllowedFileExtensions())) {
                    $result[] = $elementPath;
                }
            }

            if (is_dir($elementPath)) {
                $dirResult = $this->scanDir($elementPath);
            }
        }
        return array_merge($result, $dirResult);
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
        $list = scandir($dir);

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
