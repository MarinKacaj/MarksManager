<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/14/2015
 * Time: 2:05 PM
 */

use fti\adv_db\entity\Secretary;
use fti\adv_db\http\HttpEntityParamBuilder;

require_once dirname(dirname(__FILE__)) . '/includes/loader.php';
require_once dirname(dirname(__FILE__)) . '/pages/editHelper.php';

redirectIfNotSecretary();

$identifier = HttpEntityParamBuilder::retrieveFilter(array(Secretary::PROP_ID));
$entityBuilder = Secretary::getBuilder();
buildEditView($entityBuilder, $identifier);
require_once dirname(dirname(__FILE__)) . '/pages/formPage.php';