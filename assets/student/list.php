<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/19/2015
 * Time: 1:07 AM
 */

use fti\adv_db\entity\Student;

require_once dirname(dirname(__FILE__)) . '/includes/loader.php';
require_once dirname(dirname(__FILE__)) . '/pages/listHelper.php';

redirectIfNotSecretary();

$entityBuilder = Student::getBuilder();
buildListView($entityBuilder);
require_once dirname(dirname(__FILE__)) . '/pages/listPage.php';