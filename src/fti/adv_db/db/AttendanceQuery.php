<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 7/3/2015
 * Time: 1:15 AM
 */

namespace fti\adv_db\db;


require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class AttendanceQuery
 * @package fti\adv_db\db
 */
class AttendanceQuery extends SelectQuery
{


    function __construct($professorID)
    {
        $this->db = new DefaultDatabase();

        $professorID = intval($professorID);
    }
}