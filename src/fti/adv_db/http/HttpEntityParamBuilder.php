<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 6/12/2015
 * Time: 10:47 AM
 */

namespace fti\adv_db\http;


require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class HttpEntityParamBuilder
 * @package fti\adv_db\http
 */
class HttpEntityParamBuilder
{

    /**
     * @return array
     */
    public static function buildParams()
    {
        return array_merge($_POST, $_GET);
    }


}