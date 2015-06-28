<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/23/2015
 * Time: 9:22 PM
 */

require_once dirname(__FILE__) . '/session.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/http_utils.php';

$baseURL = get_assets_base_url();

?>

<li>
    <a href="<?php echo $baseURL . 'personal/changePasswordView.php' ?>">
        Ndrysho fjal&euml;kalimin
    </a>
</li>