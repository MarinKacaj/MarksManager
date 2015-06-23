<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/23/2015
 * Time: 1:27 PM
 */

use fti\adv_db\db\SelectQuery;

require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/auth.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');


$email = $_POST[EMAIL];
$password = $_POST[PASSWORD];
$actor = $_POST[ACTOR];
$selectQuery = new SelectQuery(array(), array($actor), array(EMAIL => $email, PASSWORD => $password));
$result = $selectQuery->exec();
if ($result) {
    $_SESSION[LOGGED_IN_USER_ROLE] = $actor;
}