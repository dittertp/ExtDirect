<?php
/**
 * Created by PhpStorm.
 * User: dittertp
 * Date: 10.10.14
 * Time: 09:55
 */

namespace ExtDirect\Annotations;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use ReflectionClass;
use Application\DemoApp;

class Parser
{

    /**
     * @var array
     */
    protected $allowedFileExtensions;

    /**
     * @var string
     */
    protected $namespace;

    /**
     * constructor
     */
    public function __construct()
    {
        // sets a array containing all allowed file extensions
        $this->allowedFileExtensions = array("php");
    }

    /**
     * sets the basic namespace which is used to scan after remotable classes/actions
     *
     * @param string $namespace base namespace
     *
     * @return void
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * Returns application namespace
     *
     * @return string
     */
    protected function getNamespace()
    {
        return $this->namespace;
    }

    /**
     *
     */
    public function run()
    {
        $list = $this->getClassList();

        foreach ($list as $class) {

            $this->validateClass($class);
        }
    }

    protected function validateClass($class)
    {

        $annotationReader = new AnnotationReader();

        AnnotationRegistry::registerLoader('class_exists');

        if (!class_exists("\\".$class)) {
            error_log(" '{$class}' does not exist!");
        }

        //Get class annotation
        $reflectionClass = new ReflectionClass($class);
        $classAnnotation = $annotationReader->getClassAnnotation($reflectionClass, "ExtDirect\Annotations\Direct");
        //$classAnnotations = current($classAnnotations);

        if ($classAnnotation instanceof \ExtDirect\Annotations\Direct) {

            $classAnnotation->setClassName($class);

            error_log(var_export($classAnnotation,true));

            foreach ($reflectionClass->getMethods() as $reflectionMethod) {

                $methodAnnotation = $annotationReader->getMethodAnnotation($reflectionMethod, "ExtDirect\Annotations\Remotable");

                if ($methodAnnotation instanceof \ExtDirect\Annotations\Remotable) {
                    error_log(var_export($methodAnnotation,true));
                }
            }


        }

    }

    /**
     * Returns a flat array containing all Classes which
     *
     * @return array
     */
    protected function getClassList()
    {
        return $this->scanDir($this->getNamespace());
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
                //$fileExtension = pathinfo($element, PATHINFO_EXTENSION);

                $fileInfo = pathinfo($element);
                if (in_array($fileInfo['extension'], $this->getAllowedFileExtensions())) {
                    error_log(print_r($fileInfo,true));
                    $result[] = $this->getNamespace() . "\\" . $fileInfo['filename'];
                    //$result[] = $elementPath;
                }
            }

        }

        return $result;
    }
} 