<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/28/2015
 * Time: 9:57 PM
 */

use fti\adv_db\entity\Group;
use fti\adv_db\entity\Season;
use fti\adv_db\entity\Subject;

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/gen_purpose.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

redirectIfNotProfessor();

$seasonInstances = Season::getBuilder()->getList();
$subjectInstances = Subject::getBuilder()->getList();
$groupInstances = Group::getBuilder()->getList();

?>

<!DOCTYPE html>
<html>
<?php require_once dirname(dirname(__FILE__)) . '/includes/head.php'; ?>
<body>
<?php require_once dirname(dirname(__FILE__)) . '/includes/navigation.php'; ?>
<div id="wrapper">
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Rezultatet</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Zgjidhni flet&euml;n e provimit me an&euml; t&euml; filtrave t&euml; m&euml;posht&euml;m
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <form role="form" action="list.php" method="get">
                                    <!-- start of my stuff -->
                                    <div class="form-group">
                                        <label for="season" class="control-label">Sezoni</label>
                                        <select name="<?php echo Season::TABLE_NAME; ?>" class="form-control" id="season">
                                            <?php foreach ($seasonInstances as $seasonInstance) : ?>
                                                <option
                                                    value="<?php echo $seasonInstance->getProperty(Season::PROP_ID)->getValue(); ?>">
                                                    <?php echo $seasonInstance->getDisplayName(); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="subject" class="control-label">L&euml;nda</label>
                                        <select name="<?php echo Subject::TABLE_NAME; ?>" class="form-control" id="subject">
                                            <?php foreach ($subjectInstances as $subjectInstance) : ?>
                                                <option
                                                    value="<?php echo $subjectInstance->getProperty(Subject::PROP_ID)->getValue(); ?>">
                                                    <?php echo $subjectInstance->getDisplayName(); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="group" class="control-label">Grupi</label>
                                        <select name="<?php echo Group::TABLE_NAME; ?>" class="form-control" id="group">
                                            <?php foreach ($groupInstances as $groupInstance) : ?>
                                                <option
                                                    value="<?php echo $groupInstance->getProperty(Group::PROP_ID)->getValue(); ?>">
                                                    <?php echo $groupInstance->getDisplayName(); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="<?php echo RESULT_IS_FOR_IMPROVEMENT; ?>" />
                                                P&euml;rmir&euml;sim
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-default">K&euml;rko</button>
                                    <!-- end of my stuff -->
                                </form>
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
