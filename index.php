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
$markSelectEl = $viewGenerator->createMarkSelectBlock('mark1');
$dateInputEl = $viewGenerator->createDateInputBlock('Date', '2010-03-21', 'date1');
$domDocument = $viewGenerator->getDOMDocument();
$domDocument->appendChild($inputEl);
$domDocument->appendChild($markSelectEl);
$domDocument->appendChild($dateInputEl);
echo html_entity_decode($domDocument->saveHTML());