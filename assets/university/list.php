
<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/19/2015
 * Time: 1:07 AM
 */

use fti\adv_db\aggregator\ListViewAggregator;
use fti\adv_db\entity\University;

require_once dirname(dirname(__FILE__)) . '/includes/loader.php';
require_once dirname(dirname(__FILE__)) . '/pages/listHelper.php';

redirectIfNotSecretary();

$entityBuilder = University::getBuilder();
$entityInstances = $entityBuilder->getList();

$isEmpty = false;
if (empty($entityInstances)) {
    $isEmpty = true;
    array_push($entityInstances, $entityBuilder->createEmpty());
}
$listViewAggregator = new ListViewAggregator($entityInstances, false);
$listViewAggregator->setIsUpdateButtonDisplayed(false);
$listViewAggregator->setIsDeleteButtonDisplayed(false);

$contentHeader = $entityBuilder->getLabel();
$contentAction = 'Lista';
$contentHTML = $listViewAggregator->buildListHTML($isEmpty, false);

$GLOBALS[CONTENT_HEADER] = $contentHeader;
$GLOBALS[CONTENT_ACTION] = $contentAction;
$GLOBALS[CONTENT_HTML] = $contentHTML;

require_once dirname(dirname(__FILE__)) . '/pages/listPage.php';