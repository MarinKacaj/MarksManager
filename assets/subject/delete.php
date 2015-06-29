<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/14/2015
 * Time: 4:49 PM
 */

use fti\adv_db\entity\Subject;
use fti\adv_db\http\HttpEntityParamBuilder;
use fti\adv_db\nav\ActionNavigator;

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

redirectIfNotSecretary();


$id = HttpEntityParamBuilder::retrieveFilter(array(Subject::PROP_ID));
$subjectInstance = Subject::getBuilder()->getByIdentifier($id);
$actionNavigator = new ActionNavigator($subjectInstance);
$actionNavigator->deleteAndRedirect();