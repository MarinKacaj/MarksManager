<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/24/2015
 * Time: 1:54 PM
 */

use fti\adv_db\entity\Professor;
use fti\adv_db\entity\Secretary;
use fti\adv_db\entity\Student;
use fti\adv_db\entity\UserEntity;
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

function redirectIfNotStudent()
{
    redirectIfUnauthorized(array(Student::TABLE_NAME));
}

function redirectIfNotSecretary()
{
    redirectIfUnauthorized(array(Secretary::TABLE_NAME));
}

function redirectIfNotProfessor()
{
    redirectIfUnauthorized(array(Professor::TABLE_NAME));
}

/**
 * @return bool
 */
function isLogInActive() {
    $isLoginActive = isset($_SESSION[LOGGED_IN_USER_ID]) && isset($_SESSION[LOGGED_IN_USER_ROLE]);
    return $isLoginActive;
}

function redirectIfLoggedIn()
{
    $actionNavigator = new ActionNavigator(null);

    if (isLogInActive()) {
        $actionNavigator->redirectToMainPage();
    }
}

function redirectIfNotLoggedIn()
{
    $actionNavigator = new ActionNavigator(null);

    if (!isLogInActive()) {
        $actionNavigator->logOutAndRedirect();
    }
}

/**
 * @param string $tableName
 * @param array $loginFilter
 * @return bool|UserEntity
 */
function getLoggedInUserByFilter($tableName, $loginFilter)
{

    switch ($tableName) {

        case Student::TABLE_NAME:
            $userInstance = Student::getBuilder()->filterByParams($loginFilter);
            break;
        case Professor::TABLE_NAME:
            $userInstance = Professor::getBuilder()->filterByParams($loginFilter);
            break;
        case Secretary::TABLE_NAME:
            $userInstance = Secretary::getBuilder()->filterByParams($loginFilter);
            break;
        default:
            $userInstance = false;
            break;
    }

    return $userInstance;
}

/**
 * @param string $tableName
 * @param string $email
 * @param string $password
 * @return bool|UserEntity
 */
function getLoggedInUserByCredentials($tableName, $email, $password)
{
    $loginFilter = array(UserEntity::PROP_EMAIL => $email, UserEntity::PROP_PASSWORD => $password);
    $userInstance = getLoggedInUserByFilter($tableName, $loginFilter);
    return $userInstance;
}

/**
 * @return bool|UserEntity
 */
function getCurrentlyLoggedInUser()
{
    $userID = intval($_SESSION[LOGGED_IN_USER_ID]);
    $userRole = $_SESSION[LOGGED_IN_USER_ROLE];
    $userIdentifier = array(UserEntity::PROP_ID => $userID);
    $userInstance = getLoggedInUserByFilter($userRole, $userIdentifier);
    return $userInstance;
}