<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/23/2015
 * Time: 1:27 PM
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
 * @param string $tableName
 * @param string $email
 * @param string $password
 * @return bool|UserEntity
 */
function get_logged_in_user($tableName, $email, $password)
{
    $loginFilter = array(UserEntity::PROP_EMAIL => $email, UserEntity::PROP_PASSWORD => $password);

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

function main()
{
    $email = $_POST[EMAIL];
    $password = $_POST[PASSWORD];
    $actor = $_POST[ACTOR];
    $userInstance = get_logged_in_user($actor, $email, $password);
    $actionNavigator = new ActionNavigator($userInstance);
    $actionNavigator->logInAndRedirect($actor);
}

main();