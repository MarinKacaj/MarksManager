<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/8/2015
 * Time: 6:14 PM
 */

use fti\adv_db\entity\Professor;

require_once dirname(dirname(__FILE__)) . '/includes/loader.php';
require_once dirname(dirname(__FILE__)) . '/pages/createHelper.php';

redirectIfNotSecretary();

$entityBuilder = Professor::getBuilder();
buildCreateView($entityBuilder);
require_once dirname(dirname(__FILE__)) . '/pages/formPage.php';