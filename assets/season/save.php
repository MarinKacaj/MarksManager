<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/12/2015
 * Time: 12:08 PM
 */

use fti\adv_db\entity\Season;
use fti\adv_db\http\HttpEntityParamBuilder;
use fti\adv_db\nav\ActionNavigator;

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

redirectIfNotSecretary();


$params = HttpEntityParamBuilder::buildParams();
$seasonInstance = new Season($params);
$actionNavigator = new ActionNavigator($seasonInstance);
$actionNavigator->saveAndRedirect();
