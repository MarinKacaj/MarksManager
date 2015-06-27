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

if (isset($GLOBALS[REPORT_CODE])) {
    $loginErrorCode = $GLOBALS[REPORT_CODE];
    switch ($loginErrorCode) {
        case REPORT_LOGIN_ERROR_INVALID_CREDENTIALS:
            $errorMessage = 'Kredenciale t&euml; gabuara!';
            break;
        case REPORT_LOGGED_OUT:
            $errorMessage = 'Ju nuk jeni loguar n&euml; sistem.';
            break;
        case REPORT_PASSWORD_MISMATCH:
            $errorMessage = 'S&euml; paku nj&euml;ri nga fjal&euml;kalimet nuk p&euml;puthet!';
            break;
    }
}
?>

<?php if ($errorMessage) : ?>
    <div class="form-group">
        <div class="text-center red-text"><?php echo $errorMessage; ?></div>
    </div>
<?php endif; ?>