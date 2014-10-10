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
        if (class_exists($class)) {
            $rc = new \ReflectionClass($class);
            $doc = $rc->getDocComment();
            $this->getRemotableMethods($rc);
        } else {
            error_log("Parser: Class does not exist");
        }

    }

    protected function getRemotableMethods(\ReflectionClass $rc)
    {
        $methods = array();
        foreach ($rc->getMethods() as $method) {

            $methodInfo = $this->validateMethod($method);
            if ($methodInfo) {
                array( 'name' => $method->getName(), 'len' => $method->getNumberOfParameters() );
            }
        }

    }

    protected function validateMethod(\ReflectionMethod $method)
    {
        // only public method are remotable
        if (!$method->isPublic()) {
            return false;
        }

        $doc = $method->getDocComment();




    }

    /**
     * Parse docComment for given tag
     *
     * @param string $doc the doc comment
     * @param string $tag the tag to find
     *
     * @return mixed
     */
    protected function parseDocComment($doc, $tag)
    {
        $matches = array();
        preg_match("/".$tag.":(.*)(\\r\\n|\\r|\\n)/U", $doc, $matches);
        if (isset($matches[1])) {

            $tagLine = trim($matches[1]);
            $tagParams = $this->parseCommentTag($tagLine);

            if ($tagParams !== false) {

            }


        } else {
            return false;
        }




    }

    protected function parseCommentTag($tag)
    {
        $tag = $this->stripBrackets($tag);

        $tagParams = explode(",", $tag);

        foreach ($tagParams as $param) {
            $tmp = explode("=", $param);


        }

    }

    protected function stripBrackets($tag)
    {
        if (($start = strpos($tag, "(")) === false) {
            return false;
        }

        $tag = substr($tag, $start);

        if (($end = strpos($tag, ")")) === false) {
            return false;
        }

        $strippedString = substr($tag, 0, $start);

        return $strippedString;
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
                $fileExtension = pathinfo($element, PATHINFO_EXTENSION);
                if (in_array($fileExtension, $this->getAllowedFileExtensions())) {
                    $result[] = $elementPath;
                }
            }

        }

        return $result;
    }
}
