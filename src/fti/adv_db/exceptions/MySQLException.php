<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/21/2015
 * Time: 10:02 PM
 */

namespace fti\adv_db\exceptions;


use Exception;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class MySQLException
 * @package fti\adv_db\exceptions
 */
class MySQLException extends Exception
{

    /**
     * @const int
     */
    const DEFAULT_ERROR_CODE = -1;

    /**
     * @var int
     */
    private $errorNumber;
    /**
     * @var string
     */
    private $message;

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