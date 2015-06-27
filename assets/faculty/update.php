<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/13/2015
 * Time: 7:29 PM
 */

use fti\adv_db\entity\Faculty;
use fti\adv_db\http\HttpEntityParamBuilder;
use fti\adv_db\nav\ActionNavigator;

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

redirectIfNotSecretary();


$params = HttpEntityParamBuilder::buildParams();
$facultyInstance = new Faculty($params);
$actionNavigator = new ActionNavigator($facultyInstance);
$actionNavigator->updateAndRedirect();