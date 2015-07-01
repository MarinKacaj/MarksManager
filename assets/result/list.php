<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/28/2015
 * Time: 4:30 PM
 */

use fti\adv_db\entity\ExamResult;
use fti\adv_db\entity\Group;
use fti\adv_db\entity\Professor;
use fti\adv_db\entity\Season;
use fti\adv_db\entity\Subject;
use fti\adv_db\http\HttpEntityParamBuilder;

require_once dirname(dirname(__FILE__)) . '/includes/loader.php';
require_once dirname(dirname(__FILE__)) . '/pages/listHelper.php';

redirectIfNotProfessor();

$currentlyLoggedInProfessor = getCurrentlyLoggedInUser();
$professorID = $currentlyLoggedInProfessor->getProperty(Professor::PROP_ID)->getValue();
$filters = HttpEntityParamBuilder::retrieveFilter(array(Season::TABLE_NAME, Subject::TABLE_NAME, Group::TABLE_NAME));
$seasonID = intval($filters[Season::TABLE_NAME]);
$subjectID = intval($filters[Subject::TABLE_NAME]);
$groupID = intval($filters[Group::TABLE_NAME]);
$isImprovement = isset($_GET[RESULT_IS_FOR_IMPROVEMENT]) ? true : false;

$entityBuilder = ExamResult::getBuilder();
$examResultInstances = ExamResult::getFilteredList($seasonID, $subjectID, $groupID, $professorID, $isImprovement);
buildListViewFromList($entityBuilder, $examResultInstances, true, false);
require_once dirname(dirname(__FILE__)) . '/pages/listPage.php';