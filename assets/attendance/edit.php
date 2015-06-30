<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/14/2015
 * Time: 2:05 PM
 */

use fti\adv_db\entity\Attendance;
use fti\adv_db\http\HttpEntityParamBuilder;

require_once dirname(dirname(__FILE__)) . '/includes/loader.php';
require_once dirname(dirname(__FILE__)) . '/pages/editHelper.php';

redirectIfNotProfessor();

$identifier = HttpEntityParamBuilder::retrieveFilter(array(
        Attendance::PROP_DEPARTMENT_ID, Attendance::PROP_STUDENT_ID, Attendance::PROP_SUBJECT_ID
    )
);
$entityBuilder = Attendance::getBuilder();
buildEditView($entityBuilder, $identifier);
require_once dirname(dirname(__FILE__)) . '/pages/formPage.php';