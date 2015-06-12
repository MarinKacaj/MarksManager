<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/12/2015
 * Time: 3:33 PM
 */

namespace fti\adv_db\db;


use fti\adv_db\query\DefaultDatabase;
use mysqli_result;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class BasicQuery
 * @package fti\adv_db\db
 */
abstract class BasicQuery
{

    /**
     * @var DefaultDatabase
     */
    protected $db;

    /**
     * @return string
     */
    abstract public function getQuery();

    /**
     * @return bool|mysqli_result
     */
    public function exec()
    {
        $query = $this->getQuery();
        return $this->db->query($query);
    }
}