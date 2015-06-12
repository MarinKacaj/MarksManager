<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/12/2015
 * Time: 12:08 PM
 */

use fti\adv_db\entity\University;
use fti\adv_db\http\HttpParamBuilder;

require_once 'src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

$httpParamBuilder = new HttpParamBuilder();
$params = $httpParamBuilder->buildEntityParamMap(University::getClassName());
$universityInstance = new University($params);
var_dump($universityInstance);