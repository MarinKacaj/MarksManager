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
 */
function buildListViewFromList($entityBuilder, $entityInstances) {

    $isEmpty = false;
    if (empty($entityInstances)) {
        $isEmpty = true;
        array_push($entityInstances, $entityBuilder->createEmpty());
    }
    $formViewAggregator = new ListViewAggregator($entityInstances);

    $contentHeader = $entityBuilder->getLabel();
    $contentAction = 'Lista';
    $contentHTML = $formViewAggregator->buildListHTML($isEmpty);

    $GLOBALS[CONTENT_HEADER] = $contentHeader;
    $GLOBALS[CONTENT_ACTION] = $contentAction;
    $GLOBALS[CONTENT_HTML] = $contentHTML;
}

/**
 * @param EntityBuilderHelper $entityBuilder
 */
function buildListView($entityBuilder)
{
    $entityInstances = $entityBuilder->getList();
    buildListViewFromList($entityBuilder, $entityInstances);
}