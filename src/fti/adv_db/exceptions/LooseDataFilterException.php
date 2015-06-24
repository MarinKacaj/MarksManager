<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/23/2015
 * Time: 7:33 PM
 */

namespace fti\adv_db\exceptions;


use Exception;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class LooseDataFilterException
 * @package fti\adv_db\exceptions
 */
class LooseDataFilterException extends Exception
{

    /**
     * @const int
     */
    const DEFAULT_ERROR_CODE = -10;

    /**
     * @var int
     */
    private $errorNumber;
    /**
     * @var string
     */
    protected $message;

    /**
     * @param int $errorNumber [optional]
     * @param string $message [optional]
     */
    function __construct($errorNumber = self::DEFAULT_ERROR_CODE, $message = '')
    {
        $this->errorNumber = $errorNumber;
        $this->message = $message;
    }


    public function getErrorNumber()
    {
        return $this->errorNumber;
    }
}