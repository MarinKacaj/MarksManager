<?php
use fti\adv_db\entity\Professor;
use fti\adv_db\entity\Secretary;
use fti\adv_db\entity\Student;

require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/auth.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';
spl_autoload_register('class_auto_loader');
?>

<!DOCTYPE html>
<html>
<?php require_once dirname(dirname(__FILE__)) . '/includes/head.php'; ?>
<body>
<?php require_once dirname(dirname(__FILE__)) . '/includes/navigation.php'; ?>
<div class="container">
    <div class="well text-center" id="mainTitle"><h4>TITULL</h4></div>
    <form id="loginForm" class="form-horizontal" action="loginAuthentication.php" method="post">
        <div class="well col-sm-4 col-sm-offset-4">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

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
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Sign in</button>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
