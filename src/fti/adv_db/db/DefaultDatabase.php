<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/12/2015
 * Time: 2:22 PM
 */

namespace fti\adv_db\db;


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
    private $db;

    public function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        $this->db->set_charset(DB_CHARSET);
    }


    /**
     * @param string $query
     * @return bool|mysqli_result
     */
    public function query($query)
    {
        $query = $this->db->real_escape_string($query);
        return $this->db->query($query);
    }


}