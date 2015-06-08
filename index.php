<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/8/2015
 * Time: 6:14 PM
 */

require_once 'src/fti/adv_db/view/ViewGenerator.php';

use fti\adv_db\view\ViewGenerator;

$viewGenerator = new ViewGenerator();
$inputEl = $viewGenerator->createTextInputBlock('Field1', 'field1', 'field1');
$domDocument = $viewGenerator->getDOMDocument();
$domDocument->appendChild($inputEl);
echo html_entity_decode($domDocument->saveHTML());