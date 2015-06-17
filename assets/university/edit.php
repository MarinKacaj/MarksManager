<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/14/2015
 * Time: 2:05 PM
 */

use fti\adv_db\aggregator\FormViewAggregator;
use fti\adv_db\entity\University;
use fti\adv_db\http\HttpEntityParamBuilder;

require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');


$identifier = HttpEntityParamBuilder::retrieveIdentifier(array(University::PROP_ID));
$universityInstance = University::getBuilder()->getByIdentifier($identifier);
$formViewAggregator = new FormViewAggregator($universityInstance);
echo $formViewAggregator->buildEntityFormHTML();