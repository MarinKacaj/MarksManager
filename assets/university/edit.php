<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/14/2015
 * Time: 2:05 PM
 */

use fti\adv_db\aggregator\FormViewAggregator;
use fti\adv_db\entity\University;

require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');


$id = \fti\adv_db\http\HttpEntityParamBuilder::retrieveID(University::getPrimaryKeyColName());
$universityInstance = University::retrieve($id);
$formViewAggregator = new FormViewAggregator($universityInstance);
echo $formViewAggregator->buildEntityFormHTML();