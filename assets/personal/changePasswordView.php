<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/25/2015
 * Time: 10:23 PM
 */

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/auth.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

redirectIfNotLoggedIn();


require_once dirname(dirname(__FILE__)) . '/auth/errorCodeSetter.php';

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
                <h2 class="page-header">Fjal&euml;kalimi</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Ndrysho</div>
                    <div class="panel-body">
                        <?php require_once dirname(dirname(__FILE__)) . '/includes/errorMessage.php'; ?>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="oldPassword">Fjal&euml;kalimi i vjet&euml;r</label>
                                    <input type="password" class="form-control" name="<?php echo OLD_PASSWORD; ?>"
                                           id="oldPassword"/>
                                </div>
                                <div class="form-group">
                                    <label for="currentPassword">Fjal&euml;kalimi i ri</label>
                                    <input type="password" class="form-control" name="<?php echo PASSWORD; ?>"
                                           id="currentPassword"/>
                                </div>
                                <div class="form-group">
                                    <label for="currentPasswordConfirmation">Konfirmoni fjal&euml;kalimin e ri</label>
                                    <input type="password" class="form-control" name="<?php echo PASSWORD_CONFIRMATION; ?>"
                                           id="currentPasswordConfirmation"/>
                                </div>
                                <button type="submit" class="btn btn-default">P&euml;rdit&euml;so</button>
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