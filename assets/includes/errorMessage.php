<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/23/2015
 * Time: 8:33 PM
 */

require_once dirname(__FILE__) . '/session.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/auth.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/gen_purpose.php';

$errorMessage = '';

if (isset($GLOBALS[REPORT_CODE])) {
    $loginErrorCode = $GLOBALS[REPORT_CODE];
    switch ($loginErrorCode) {
        case REPORT_LOGIN_ERROR_INVALID_CREDENTIALS:
            $errorMessage = 'Kredenciale t&euml; gabuara!';
            break;
        case REPORT_LOGGED_OUT:
            $errorMessage = 'Ju nuk jeni m&euml; loguar n&euml; sistem.';
            break;
        case REPORT_PASSWORD_MISMATCH:
            $errorMessage = 'S&euml; paku nj&euml;ri nga fjal&euml;kalimet nuk p&euml;puthet!';
            break;
        case MYSQL_ERROR_FOREIGN_KEY_CONSTRAINT_VIOLATED:
            $errorMessage = 'Elementi nuk mund t&euml; fshihet. Element&euml; t&euml; tjer&euml; varen prej tij.';
            break;
        case EXAM_ERROR_CONSTRAINT_VIOLATION:
            $errorMessage = 'Pedagog&euml;t nuk mund t&euml; jen&euml; i nj&euml;jti person.';
            break;
        case FACULTY_ERROR_CONSTRAINT_VIOLATION:
            $errorMessage = 'Sekretaret nuk mund t&euml; jen&euml; i nj&euml;jti person.';
            break;
    }
}
?>

<?php if ($errorMessage) : ?>
    <div class="form-group">
        <div class="text-center red-text"><?php echo $errorMessage; ?></div>
    </div>
<?php endif; ?>