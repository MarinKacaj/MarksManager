<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/13/2015
 * Time: 7:29 PM
 */

use fti\adv_db\entity\University;
use fti\adv_db\http\HttpEntityParamBuilder;

require_once 'src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

$params = HttpEntityParamBuilder::buildParams();
$universityInstance = new University($params);

// TODO - For demo purposes only: delete the code below on stable release
var_dump($universityInstance);