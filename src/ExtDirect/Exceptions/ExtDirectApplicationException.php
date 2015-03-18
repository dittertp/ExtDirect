<?php

/**
 * ExtDirect\Exceptions\ExtDirectApplicationException
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

namespace ExtDirect\Exceptions;

/**
 * class ExtDirectApplicationException
 *
 * @category  ExtDirect
 * @package   ExtDirect
 * @author    Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright 2015 Philipp Dittert
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License, version 3 (GPL-3.0)
 * @link      https://github.com/dittertp/ExtDirect
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
