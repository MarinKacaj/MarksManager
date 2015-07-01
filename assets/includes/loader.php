<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/30/2015
 * Time: 10:13 PM
 */

require_once dirname(__FILE__) . '/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/gen_purpose.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/http_utils.php';

spl_autoload_register('class_auto_loader');