<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/23/2015
 * Time: 9:23 PM
 */


require_once dirname(__FILE__) . '/session.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/http_utils.php';

$baseURL = get_assets_base_url();

?>

<li>
    <a href="<?php echo $baseURL . 'attendance/list.php' ?>">
        Frekuentimi
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . 'result/filter.php' ?>">
        Flet&euml; Provimi
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . 'personal/changePasswordView.php' ?>">
        Ndrysho fjal&euml;kalimin
    </a>
</li>