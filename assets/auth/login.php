<?php
use fti\adv_db\entity\Professor;
use fti\adv_db\entity\Secretary;
use fti\adv_db\entity\Student;

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/auth.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/gen_purpose.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

redirectIfLoggedIn();


require_once dirname(dirname(__FILE__)) . '/auth/errorCodeSetter.php';

?>

<!DOCTYPE html>
<html>
<?php require_once dirname(dirname(__FILE__)) . '/includes/head.php'; ?>
<body>
<?php require_once dirname(dirname(__FILE__)) . '/includes/navigation.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Logohuni</h3>
                </div>
                <div class="panel-body">
                    <form role="form" id="loginForm" class="form-horizontal" action="loginAuthentication.php" method="post">
                        <fieldset>
                            <?php require_once dirname(dirname(__FILE__)) . '/includes/errorMessage.php'; ?>
                            <div class="form-group left-text-container">
                                <label for="inputEmail3" class="col-sm-2 control-label left-text">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="<?php echo EMAIL; ?>" class="form-control" id="inputEmail3"
                                           placeholder="Email"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                                <div class="col-sm-10">
                                    <input type="password" name="<?php echo PASSWORD; ?>" class="form-control" id="inputPassword3"
                                           placeholder="Password"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="<?php echo ACTOR; ?>" value="<?php echo Student::TABLE_NAME; ?>"/>Student
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="<?php echo ACTOR; ?>"
                                                   value="<?php echo Professor::TABLE_NAME; ?>"/>Profesor
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="<?php echo ACTOR; ?>"
                                                   value="<?php echo Secretary::TABLE_NAME; ?>"/>Sekretare
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button class="btn btn-lg btn-block">Login</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>