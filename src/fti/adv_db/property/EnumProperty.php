<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 6/11/2015
 * Time: 4:19 PM
 */

namespace fti\adv_db\property;


require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

class EnumProperty
{

    /**
     * @var array
     */
    private $value;

}