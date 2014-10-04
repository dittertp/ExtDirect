<?php

/**
 * ExtDirect\AbstractExtDirect
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
 * class AbstractExtDirect
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

abstract class AbstractExtDirect
{
    /**
     * @var RequestParameters
     */
    protected $requestParameters;

    /**
     * Returns request parameters instance
     *
     * @return RequestParameters
     */
    public function getParameters()
    {
        return $this->requestParameters;
    }

    /**
     * injects the request parameters
     *
     * @param RequestParameters $parameters the request parameters interface
     *
     * @return void
     */
    public function injectParameters(RequestParameters $parameters)
    {
        $this->requestParameters = $parameters;
    }
}
