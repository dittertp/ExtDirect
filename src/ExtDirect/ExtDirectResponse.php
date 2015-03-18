<?php

/**
 * ExtDirect\ExtDirectResponse
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

namespace ExtDirect;

/**
 * class ExtDirectResponse
 *
 * @category  ExtDirect
 * @package   ExtDirect
 * @author    Philipp Dittert <philipp.dittert@gmail.com>
 * @copyright 2015 Philipp Dittert
 * @license   http://www.gnu.org/licenses/gpl.txt GNU General Public License, version 3 (GPL-3.0)
 * @link      https://github.com/dittertp/ExtDirect
 */

class ExtDirectResponse extends AbstractExtDirect
{
    /**
     * @var array
     */
    protected $result;

    /**
     * constructor to overwrite abstract constructor
     */
    public function __construct()
    {
    }

    /**
     * Sets request result
     *
     * @param mixed $result the request result as array
     *
     * @return void
     */
    public function setResult($result)
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
    public function getResultAsArray()
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
