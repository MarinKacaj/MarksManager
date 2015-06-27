<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/25/2015
 * Time: 10:23 PM
 */

use fti\adv_db\nav\ActionNavigator;

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/auth.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

redirectIfNotLoggedIn();


function processChangedPassword()
{

    $loggedInUserInstance = getCurrentlyLoggedInUser();
    $oldPassword = $_POST[OLD_PASSWORD];
    $currentPassword = $_POST[PASSWORD];
    $currentPasswordConfirmation = $_POST[PASSWORD_CONFIRMATION];

    $isOldPasswordCorrect = $loggedInUserInstance->isPasswordCorrect($oldPassword);
    $isCurrentPasswordConfirmed = strcmp($currentPassword, $currentPasswordConfirmation) === 0;

    $loggedInUserInstance->setPassword($currentPassword);
    $actionNavigator = new ActionNavigator($loggedInUserInstance);
    $actionNavigator->changePasswordAndRedirect($isOldPasswordCorrect && $isCurrentPasswordConfirmed);

}

processChangedPassword();