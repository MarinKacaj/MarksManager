<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/8/2015
 * Time: 6:14 PM
 */

use fti\adv_db\aggregator\FormViewAggregator;
use fti\adv_db\entity\University;

require_once 'src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');


$universityInstance = new University(array(
    University::PROP_NAME => 'UPT',
    University::PROP_CITY => 'Tirana'
));
$formViewAggregator = new FormViewAggregator($universityInstance);
echo $formViewAggregator->buildEntityFormHTML();