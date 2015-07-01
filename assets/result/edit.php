<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/14/2015
 * Time: 2:05 PM
 */

use fti\adv_db\entity\Result;
use fti\adv_db\http\HttpEntityParamBuilder;

require_once dirname(dirname(__FILE__)) . '/includes/loader.php';
require_once dirname(dirname(__FILE__)) . '/pages/editHelper.php';

redirectIfNotProfessor();

$identifier = HttpEntityParamBuilder::retrieveFilter(array(Result::PROP_EXAM_ID, Result::PROP_STUDENT_ID));;
$entityBuilder = Result::getBuilder();
buildEditView($entityBuilder, $identifier);
require_once dirname(dirname(__FILE__)) . '/pages/formPage.php';