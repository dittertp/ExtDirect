<?php

/**
 * ExtDirect\Exceptions\ExtDirectApplicationException
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

namespace ExtDirect\Exceptions;

/**
 * class ExtDirectApplicationException
 *
 * @category  ExtDirect
 * @package   TechDivision_ExtDirect
 * @author    Philipp Dittert <pd@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.appserver.io
 */

class ExtDirectApplicationException extends \Exception
{
    /**
     * Additional response Parameter Field
     *
     * @var array
     */
    private $response = array();

    /**
     * exception constructor
     *
     * @param string $message  the exception message
     * @param int    $code     the exception code
     * @param mixed  $previous optional previous exception
     * @param array  $response response that will sent to client
     */
    public function __construct($message, $code = 0, $previous = null, $response = array())
    {
        parent::__construct($message, $code, $previous);

        $this->response = $response;
    }

    /**
     * Returns response as Array
     *
     * @return array
     */
    public function getResponse()
    {
        return $this->response;
    }
}
