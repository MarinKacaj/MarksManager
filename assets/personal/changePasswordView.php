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
<body>
<?php require_once dirname(dirname(__FILE__)) . '/includes/navigation.php'; ?>
<div class="container">
    <div class="well text-center" id="mainTitle"><h4>Ndrysho fjal&euml;kalimin</h4></div>
    <form action="changePasswordController.php" method="post">
        <div class="well col-sm-4 col-sm-offset-4">
            <?php require_once dirname(dirname(__FILE__)) . '/includes/errorMessage.php'; ?>
            <div class="form-group row">
                <label for="oldPassword" class="col-sm-2 control-label">Fjal&euml;kalimi i vjet&euml;r</label>

                <div class="col-sm-9 col-sm-offset-1">
                    <input type="password" name="<?php echo OLD_PASSWORD; ?>" class="form-control" id="oldPassword"
                           value=""/>
                </div>
            </div>
            <div class="form-group row">
                <label for="currentPassword" class="col-sm-2 control-label">Fjal&euml;kalimi i ri</label>

                <div class="col-sm-9 col-sm-offset-1">
                    <input type="password" name="<?php echo PASSWORD; ?>" class="form-control"
                           id="currentPassword"/>
                </div>
            </div>
            <div class="form-group row">
                <label for="currentPasswordConfirmation" class="col-sm-2 control-label">Konfirmoni fjal&euml;kalimin e
                    ri</label>

                <div class="col-sm-9 col-sm-offset-1">
                    <input type="password" name="<?php echo PASSWORD_CONFIRMATION; ?>" class="form-control"
                           id="currentPasswordConfirmation"/>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-default">Ndrysho</button>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>