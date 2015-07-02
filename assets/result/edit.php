<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/14/2015
 * Time: 2:05 PM
 */

use fti\adv_db\aggregator\FormViewAggregator;
use fti\adv_db\entity\Result;
use fti\adv_db\http\HttpEntityParamBuilder;

require_once dirname(dirname(__FILE__)) . '/includes/loader.php';
require_once dirname(dirname(__FILE__)) . '/pages/editHelper.php';

redirectIfNotProfessor();

$previousURL = $_GET[PREVIOUS_URL];
$previousURLArg = http_build_str(array(PREVIOUS_URL => $previousURL));
$identifier = HttpEntityParamBuilder::retrieveFilter(array(Result::PROP_EXAM_ID, Result::PROP_STUDENT_ID));;
$entityBuilder = Result::getBuilder();
$entityInstance = $entityBuilder->getByIdentifier($identifier);
$formViewAggregator = new FormViewAggregator($entityInstance, $previousURLArg);

$contentHeader = $entityBuilder->getLabel();
$contentAction = 'P&euml;rdit&euml;so';
$contentHTML = $formViewAggregator->buildEntityFormHTML();

$GLOBALS[CONTENT_HEADER] = $contentHeader;
$GLOBALS[CONTENT_ACTION] = $contentAction;
$GLOBALS[CONTENT_HTML] = $contentHTML;
require_once dirname(dirname(__FILE__)) . '/pages/formPage.php';