<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/28/2015
 * Time: 4:30 PM
 */

use fti\adv_db\entity\StudentResult;

require_once dirname(dirname(__FILE__)) . '/includes/loader.php';
require_once dirname(dirname(__FILE__)) . '/pages/listHelper.php';

redirectIfNotStudent();

$entityBuilder = StudentResult::getBuilder();
$currentlyLoggedInStudent = getCurrentlyLoggedInUser();
$studentResultInstances = StudentResult::getFilteredList($currentlyLoggedInStudent);
buildListViewFromList($entityBuilder, $studentResultInstances);
require_once dirname(dirname(__FILE__)) . '/pages/listPage.php';