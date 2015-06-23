<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/13/2015
 * Time: 7:29 PM
 */

use fti\adv_db\entity\Department;
use fti\adv_db\http\HttpEntityParamBuilder;
use fti\adv_db\nav\ActionNavigator;

require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

$params = HttpEntityParamBuilder::buildParams();
$departmentInstance = new Department($params);
$actionNavigator = new ActionNavigator($departmentInstance);
$actionNavigator->updateAndRedirect();