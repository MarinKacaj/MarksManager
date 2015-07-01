<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 7/1/2015
 * Time: 12:31 AM
 */

use fti\adv_db\aggregator\ListViewAggregator;
use fti\adv_db\entity\Entity;
use fti\adv_db\entity\util\EntityBuilderHelper;

require_once dirname(dirname(__FILE__)) . '/includes/loader.php';

/**
 * @param EntityBuilderHelper $entityBuilder
 * @param Entity[] $entityInstances
 * @param bool $tableHasActions [optional]
 * @param bool $appendCreateButton [optional]
 */
function buildListViewFromList($entityBuilder, $entityInstances, $tableHasActions = true, $appendCreateButton = true) {

    $isEmpty = false;
    if (empty($entityInstances)) {
        $isEmpty = true;
        array_push($entityInstances, $entityBuilder->createEmpty());
    }
    $listViewAggregator = new ListViewAggregator($entityInstances, $tableHasActions);

    $contentHeader = $entityBuilder->getLabel();
    $contentAction = 'Lista';
    $contentHTML = $listViewAggregator->buildListHTML($isEmpty, $appendCreateButton);

    $GLOBALS[CONTENT_HEADER] = $contentHeader;
    $GLOBALS[CONTENT_ACTION] = $contentAction;
    $GLOBALS[CONTENT_HTML] = $contentHTML;
}

/**
 * @param EntityBuilderHelper $entityBuilder
 * @param bool $tableHasActions [optional]
 * @param bool $appendCreateButton [optional]
 */
function buildListView($entityBuilder, $tableHasActions = true, $appendCreateButton = true)
{
    $entityInstances = $entityBuilder->getList();
    buildListViewFromList($entityBuilder, $entityInstances, $tableHasActions, $appendCreateButton);
}