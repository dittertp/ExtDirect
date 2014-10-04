<?php

/**
 * ExtDirect\ExtDirectResponse
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

/**
 * class ExtDirectResponse
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

class ExtDirectResponse extends AbstractExtDirect
{
    /**
     * @var array
     */
    protected $result;

    /**
     * Sets request result
     *
     * @param array $result the request result as array
     *
     * @return void
     */
    public function setResult(array $result)
    {
        $this->result = $result;
    }

    /**
     * Returns request result
     *
     * @return array
     */
    protected function getResult()
    {
        return $this->result;
    }

    /**
     * Returns response as array
     *
     * @return array
     */
    public function asArray()
    {
        return $this->buildResponse();
    }

    /**
     * build a valid ext direct response and returns as array
     *
     * @return array
     */
    protected function buildResponse()
    {
        $res = array();
        $res['type'] = $this->getParameters()->getType();
        $res['tid'] = $this->getParameters()->getTid();
        $res['action'] = $this->getParameters()->getAction();
        $res['method'] = $this->getParameters()->getMethod();
        $res['result'] = $this->getResult();

        return $res;
    }
}
