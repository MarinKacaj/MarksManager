<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/24/2015
 * Time: 1:54 PM
 */

use fti\adv_db\entity\Professor;
use fti\adv_db\entity\Secretary;
use fti\adv_db\nav\ActionNavigator;

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/auth.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');


/**
 * @param array $allowed_roles
 */
function redirectIfUnauthorized($allowed_roles)
{
    $actionNavigator = new ActionNavigator(null);

    $actor = $_SESSION[LOGGED_IN_USER_ROLE];
    if (!in_array($actor, $allowed_roles)) {
        $actionNavigator->redirectToMainPage();
    }
}

function redirectIfNotSecretary()
{
    redirectIfUnauthorized(array(Secretary::TABLE_NAME));
}

function redirectIfNotProfessor()
{
    redirectIfUnauthorized(array(Professor::TABLE_NAME));
}

function redirectIfLoggedIn()
{
    $actionNavigator = new ActionNavigator(null);

    if (isset($_SESSION[LOGGED_IN_USER_ID]) && isset($_SESSION[LOGGED_IN_USER_ROLE])) {
        $actionNavigator->redirectToMainPage();
    }
}