<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/30/2015
 * Time: 10:22 PM
 */

use fti\adv_db\aggregator\FormViewAggregator;
use fti\adv_db\entity\util\EntityBuilderHelper;

require_once dirname(dirname(__FILE__)) . '/includes/loader.php';


/**
 * @param EntityBuilderHelper $entityBuilder
 */
function buildCreateView($entityBuilder)
{
    $emptyEntityInstance = $entityBuilder->createEmpty();
    $formViewAggregator = new FormViewAggregator($emptyEntityInstance);

    $contentHeader = $entityBuilder->getLabel();
    $contentAction = 'Shto';
    $contentHTML = $formViewAggregator->buildEntityFormHTML();

    $GLOBALS[CONTENT_HEADER] = $contentHeader;
    $GLOBALS[CONTENT_ACTION] = $contentAction;
    $GLOBALS[CONTENT_HTML] = $contentHTML;
}