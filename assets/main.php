<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/23/2015
 * Time: 9:13 PM
 */

require_once dirname(__FILE__) . '/includes/session.php';
require_once dirname(__FILE__) . '/auth/security.php';
require_once dirname(dirname(__FILE__)) . '/src/fti/adv_db/constants/gen_purpose.php';
require_once dirname(dirname(__FILE__)) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');


