<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/25/2015
 * Time: 8:16 PM
 */

use fti\adv_db\dom\DefaultAttributeValues;

require_once dirname(dirname(__FILE__)) . '/includes/session.php';

require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/http_utils.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

$baseURL = get_assets_base_url();

?>

<script type="text/javascript" src="<?php echo $baseURL; ?>js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo $baseURL; ?>js/init.date.picker.js"></script>
<script type="text/javascript">

    var dateInputWrapperClassName = "<?php echo DefaultAttributeValues::CL_DATE_TIME_PICKER; ?>";
    var dateInputSelector = "." + dateInputWrapperClassName + " input";

    if (window.addEventListener) {
        window.addEventListener("load", function () {
            initDatePicker(dateInputSelector);
        }, false);
    } else {
        window.onload = function () {
            initDatePicker(dateInputSelector);
        };
    }
</script>