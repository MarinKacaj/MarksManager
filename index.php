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
$simpleInputBlock = $viewGenerator->createTextInputBlock('Field1', 'field1', 'field1');
$markSelectBlock = $viewGenerator->createMarkSelectBlock('mark1');
$dateInputBlock = $viewGenerator->createDateInputBlock('Date', '2010-03-21', 'date1');
$submitButtonBlock = $viewGenerator->createSubmitButton('Submit');
$domDocument = $viewGenerator->getDOMDocument();
$domDocument->appendChild($simpleInputBlock);
$domDocument->appendChild($markSelectBlock);
$domDocument->appendChild($dateInputBlock);
$domDocument->appendChild($submitButtonBlock);
echo html_entity_decode($domDocument->saveHTML());