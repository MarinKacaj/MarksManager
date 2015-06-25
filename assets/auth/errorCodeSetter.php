<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/26/2015
 * Time: 12:09 AM
 */

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/auth.php';


if (isset($_GET[REPORT_CODE])) {
    $GLOBALS[REPORT_CODE] = intval($_GET[REPORT_CODE]);
}