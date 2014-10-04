<?php

/**
 * ExtDirect\RequestParameters
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

namespace ExtDirect;

use ExtDirect\Exceptions\ExtDirectException;

/**
 * class RequestParameters
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

class RequestParameters
{
    /**
     * @var array
     */
    protected $requiredParameters = array("type", "id", "action", "method", "data");

    /**
     * @var string
     */
    protected $type;

    /**
     * @var integer
     */
    protected $tid;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $data;

    /**
     * Sets the ext direct action
     *
     * @param string $action the ext direct action
     *
     * @return void
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * Returns the ext direct action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Sets the ext direct type
     *
     * @param string $type the ext direct type
     *
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Returns the ext direct type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the ext direct request id
     *
     * @param int $tid the ext direct request id
     *
     * @return void
     */
    public function setTid($tid)
    {
        $this->tid = $tid;
    }

    /**
     * Returns the ext direct request id
     *
     * @return int
     */
    public function getTid()
    {
        return $this->tid;
    }

    /**
     * Sets the ext direct request data (post body)
     *
     * @param array $data the request date
     *
     * @return void
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Returns the request data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Sets the request method
     *
     * @param string $method the request method
     *
     * @return void
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * Returns given method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Returns all required parameters
     *
     * @return array
     */
    protected function getRequiredParameters()
    {
        return $this->requiredParameters;
    }

    /**
     * try's to set all required parameters
     *
     * @param array $request the ext direct as array
     *
     * @return void
     * @throws Exceptions\ExtDirectException
     */
    public function setParameters(array $request)
    {
        foreach ($this->getRequiredParameters() as $param) {

            if (isset($request[$param])) {

                // build setter method
                $dynamicMethod = "set" . ucfirst($param);

                if (method_exists($this, $dynamicMethod)) {

                    $this->$dynamicMethod($request[$param]);

                } else {

                    throw new ExtDirectException("Method for required parameter '{$param}' not implemented");

                }

            } else {

                throw new ExtDirectException("Required parameter '{$param}' is missing");

            }
        }
    }
}
