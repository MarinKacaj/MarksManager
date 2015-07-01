<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/23/2015
 * Time: 9:22 PM
 */

require_once dirname(__FILE__) . '/session.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/gen_purpose.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/http_utils.php';

$baseURL = get_assets_base_url();
$listDefaultFileName = LIST_DEFAULT_FILE_NAME;
$createDefaultFileName = CREATE_DEFAULT_FILE_NAME;

?>

<li>
    <a href="<?php echo $baseURL . "studentResults/$listDefaultFileName" ?>">
        <i class="fa fa-dashboard fa-fw"></i>
        Rezultatet
    </a>
</li>