<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/30/2015
 * Time: 10:00 PM
 */

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/gen_purpose.php';

$contentHeader = $GLOBALS[CONTENT_HEADER];
$contentAction = $GLOBALS[CONTENT_ACTION];
$contentHTML = $GLOBALS[CONTENT_HTML];

?>


<!DOCTYPE html>
<html>
<?php require_once dirname(dirname(__FILE__)) . '/includes/head.php'; ?>
<body class="custom-body">
<div id="wrapper">
    <?php require_once dirname(dirname(__FILE__)) . '/includes/navigation.php'; ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header"><?php echo $contentHeader; ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo $contentAction; ?>
                    </div>
                    <div class="panel-body">
                        <?php require_once dirname(dirname(__FILE__)) . '/includes/errorMessage.php'; ?>
                        <div class="row">
                            <div class="col-lg-4">
                                <?php echo $contentHTML; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>