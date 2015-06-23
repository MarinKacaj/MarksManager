<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/23/2015
 * Time: 8:33 PM
 */

require_once dirname(__FILE__) . '/session.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/auth.php';

$errorMessage = '';

if (isset($GLOBALS[LOGIN_REPORT_CODE])) {
    $loginErrorCode = $GLOBALS[LOGIN_REPORT_CODE];
    switch ($loginErrorCode) {
        case REPORT_LOGIN_ERROR_INVALID_CREDENTIALS:
            $errorMessage = 'Kredenciale t&euml; gabuara!';
            break;
    }
}
?>

<?php if ($errorMessage) : ?>
    <div class="form-group">
        <div class="text-center red-text"><?php echo $errorMessage; ?></div>
    </div>
<?php endif; ?>