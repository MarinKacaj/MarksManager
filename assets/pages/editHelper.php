<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/30/2015
 * Time: 11:15 PM
 */

use fti\adv_db\aggregator\FormViewAggregator;
use fti\adv_db\entity\util\EntityBuilderHelper;

require_once dirname(dirname(__FILE__)) . '/includes/loader.php';


/**
 * @param EntityBuilderHelper $entityBuilder
 * @param array $identifier
 */
function buildEditView($entityBuilder, $identifier)
{
    $entityInstance = $entityBuilder->getByIdentifier($identifier);
    $formViewAggregator = new FormViewAggregator($entityInstance);

    $contentHeader = $entityBuilder->getLabel();
    $contentAction = 'P&euml;rdit&euml;so';
    $contentHTML = $formViewAggregator->buildEntityFormHTML();

    $GLOBALS[CONTENT_HEADER] = $contentHeader;
    $GLOBALS[CONTENT_ACTION] = $contentAction;
    $GLOBALS[CONTENT_HTML] = $contentHTML;
}