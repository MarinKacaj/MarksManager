<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/28/2015
 * Time: 9:57 PM
 */

use fti\adv_db\entity\Department;
use fti\adv_db\entity\Season;
use fti\adv_db\entity\Subject;

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

redirectIfNotProfessor();

$seasonInstances = Season::getBuilder()->getList();
$subjectInstances = Subject::getBuilder()->getList();
$departmentInstances = Department::getBuilder()->getList();

?>

<!DOCTYPE html>
<html>
<?php require_once dirname(dirname(__FILE__)) . '/includes/head.php'; ?>
<body>
<?php require_once dirname(dirname(__FILE__)) . '/includes/navigation.php'; ?>
<div class="container">
    <div class="well text-center" id="mainTitle"><h4>Filtro rezultatet</h4></div>
    <form class="form-horizontal" action="list.php" method="get">
        <div class="well col-sm-4 col-sm-offset-4">
            <?php require_once dirname(dirname(__FILE__)) . '/includes/errorMessage.php'; ?>
            <div class="form-group">
                <label for="season" class="col-sm-2 control-label">Sezoni</label>

                <div class="col-sm-10">
                    <select name="<?php echo Season::TABLE_NAME; ?>" class="form-control" id="season">
                        <?php foreach ($seasonInstances as $seasonInstance) : ?>
                            <option value="<?php echo $seasonInstance->getProperty(Season::PROP_ID)->getValue(); ?>">
                                <?php echo $seasonInstance->getDisplayName(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="subject" class="col-sm-2 control-label">L&euml;nda</label>

                <div class="col-sm-10">
                    <select name="<?php echo Subject::TABLE_NAME; ?>" class="form-control" id="subject">
                        <?php foreach ($subjectInstances as $subjectInstance) : ?>
                            <option value="<?php echo $subjectInstance->getProperty(Subject::PROP_ID)->getValue(); ?>">
                                <?php echo $subjectInstance->getDisplayName(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="department" class="col-sm-2 control-label">Dega</label>

                <div class="col-sm-10">
                    <select name="<?php echo Department::TABLE_NAME; ?>" class="form-control" id="department">
                        <?php foreach ($departmentInstances as $departmentInstance) : ?>
                            <option
                                value="<?php echo $departmentInstance->getProperty(Subject::PROP_ID)->getValue(); ?>">
                                <?php echo $departmentInstance->getDisplayName(); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">K&euml;rko</button>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
