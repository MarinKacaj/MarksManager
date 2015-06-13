<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/13/2015
 * Time: 10:29 PM
 */

use fti\adv_db\aggregator\FormViewAggregator;
use fti\adv_db\entity\Faculty;

require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');


$facultyInstance = Faculty::createEmpty();
$formViewAggregator = new FormViewAggregator($facultyInstance);
echo $formViewAggregator->buildEntityFormHTML();