<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/27/2015
 * Time: 11:37 PM
 */

namespace fti\adv_db\entity;


require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class StudentResult
 * @package fti\adv_db\entity
 */
class StudentResult extends CompositeEntity
{
}