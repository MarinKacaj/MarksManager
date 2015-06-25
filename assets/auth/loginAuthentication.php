<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/23/2015
 * Time: 1:27 PM
 */

use fti\adv_db\nav\ActionNavigator;

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/auth.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');


function main()
{
    $email = $_POST[EMAIL];
    $password = $_POST[PASSWORD];
    $actor = $_POST[ACTOR];
    $userInstance = getLoggedInUserByCredentials($actor, $email, $password);
    $actionNavigator = new ActionNavigator($userInstance);
    $actionNavigator->logInAndRedirect($actor);
}

main();