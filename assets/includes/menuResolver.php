<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/23/2015
 * Time: 9:15 PM
 */

use fti\adv_db\entity\Professor;
use fti\adv_db\entity\Secretary;
use fti\adv_db\entity\Student;

require_once dirname(__FILE__) . '/session.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/auth.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');


function resolve_menu()
{

    if (isset($_SESSION[LOGGED_IN_USER_ROLE])) {
        $actor = $_SESSION[LOGGED_IN_USER_ROLE];

        switch ($actor) {

            case Student::TABLE_NAME:
                require_once dirname(__FILE__) . '/studentMenu.php';
                break;
            case Professor::TABLE_NAME:
                require_once dirname(__FILE__) . '/professorMenu.php';
                break;
            case Secretary::TABLE_NAME:
                require_once dirname(__FILE__) . '/secretaryMenu.php';
                break;
        }
    }
}

resolve_menu();