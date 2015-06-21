<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/12/2015
 * Time: 2:22 PM
 */

namespace fti\adv_db\db;


use fti\adv_db\exceptions\MySQLException;
use mysqli;
use mysqli_result;

require_once dirname(dirname(__FILE__)) . '/constants/db_config.php';
require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class DefaultDatabase
 * @package fti\adv_db\db
 */
class DefaultDatabase
{

    /**
     * @var mysqli
     */
    private $connection;

    public function __construct()
    {
        $this->connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $this->connection->set_charset(DB_CHARSET);
    }


    /**
     * @param string $query
     * @return bool|mysqli_result
     * @throws MySQLException
     */
    public function query($query)
    {
        $result = $this->connection->query($query);
        if ($this->connection->errno) {
            throw new MySQLException($this->connection->errno);
        }
        return $result;
    }

    /**
     * @return mysqli
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param string $value
     * @return string
     */
    public function escape($value)
    {
        $value = $this->connection->real_escape_string($value);
        return $value;
    }

    /**
     * @param array $nameValuePairs
     * @return array
     */
    public function sanitizeNameValuePairs($nameValuePairs)
    {
        $sanitizedNameValuePairs = array();
        foreach ($nameValuePairs as $name => $value) {
            $name = $this->escape($name);
            $value = $this->escape($value);
            $sanitizedNameValuePairs[$name] = $value;
        }
        unset($name);
        unset($value);
        return $sanitizedNameValuePairs;
    }

    /**
     * @return mixed
     */
    public function getLastInsertedID()
    {
        return $this->connection->insert_id;
    }


}