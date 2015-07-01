<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/28/2015
 * Time: 4:30 PM
 */

use fti\adv_db\aggregator\ListViewAggregator;
use fti\adv_db\entity\ExamResult;
use fti\adv_db\entity\Group;
use fti\adv_db\entity\Professor;
use fti\adv_db\entity\Season;
use fti\adv_db\entity\Subject;
use fti\adv_db\http\HttpEntityParamBuilder;

require_once dirname(dirname(__FILE__)) . '/includes/loader.php';
require_once dirname(dirname(__FILE__)) . '/pages/listHelper.php';

redirectIfNotProfessor();

$currentlyLoggedInProfessor = getCurrentlyLoggedInUser();
$professorID = $currentlyLoggedInProfessor->getProperty(Professor::PROP_ID)->getValue();
$filters = HttpEntityParamBuilder::retrieveFilter(array(Season::TABLE_NAME, Subject::TABLE_NAME, Group::TABLE_NAME));
$seasonID = intval($filters[Season::TABLE_NAME]);
$subjectID = intval($filters[Subject::TABLE_NAME]);
$groupID = intval($filters[Group::TABLE_NAME]);
$isImprovement = isset($_GET[RESULT_IS_FOR_IMPROVEMENT]) ? true : false;

$entityBuilder = ExamResult::getBuilder();
$entityInstances = ExamResult::getFilteredList($seasonID, $subjectID, $groupID, $professorID, $isImprovement);

$isEmpty = false;
if (empty($entityInstances)) {
    $isEmpty = true;
    array_push($entityInstances, $entityBuilder->createEmpty());
} else {
    $headProfessor = Professor::getBuilder()->getByIdentifier(
        array(Professor::PROP_ID => $entityInstances[0]->getProperty(ExamResult::PROP_EXAM_HEAD_ID)->getValue())
    );
    $member1Professor = Professor::getBuilder()->getByIdentifier(
        array(Professor::PROP_ID => $entityInstances[0]->getProperty(ExamResult::PROP_EXAM_MEMBER1_ID)->getValue())
    );
    $member2Professor = Professor::getBuilder()->getByIdentifier(
        array(Professor::PROP_ID => $entityInstances[0]->getProperty(ExamResult::PROP_EXAM_MEMBER2_ID)->getValue())
    );
}
$listViewAggregator = new ListViewAggregator($entityInstances, true);
$listViewAggregator->setIsUpdateButtonDisplayed(true);
$listViewAggregator->setIsDeleteButtonDisplayed(false);

$subjectInstance = Subject::getBuilder()->getByIdentifier(array(Subject::PROP_ID => $subjectID));
$groupInstance = Group::getBuilder()->getByIdentifier(array(Group::PROP_ID => $groupID));

$contentHeader = $entityBuilder->getLabel();
$contentAction = 'Lista';
$contentHTML = $listViewAggregator->buildListHTML($isEmpty, false);

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
                        <div>
                            <table class="table table-bordered">
                                <tr>
                                    <td><strong><?php echo $groupInstance->getDisplayName(); ?></strong></td>
                                    <td>
                                        <strong>Kryetar: </strong>
                                        <?php
                                        if (isset($headProfessor)) {
                                            echo $headProfessor->getDisplayName();
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>L&euml;nda: </strong>
                                        <?php echo $subjectInstance->getDisplayName(); ?>
                                    </td>
                                    <td>
                                        <strong>Pedagogu #1: </strong>
                                        <?php
                                        if (isset($member1Professor)) {
                                            echo $member1Professor->getDisplayName();
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <strong>Pedagogu #2: </strong>
                                        <?php
                                        if (isset($member2Professor)) {
                                            echo $member2Professor->getDisplayName();
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="dataTable_wrapper">
                            <?php echo $contentHTML; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo $baseURL; ?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $baseURL; ?>js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $baseURL; ?>js/custom.js"></script>
<script type="text/javascript">
    var tableID = "<?php echo DATA_TABLE_ID; ?>";
    initDataTable(tableID);
</script>
</body>
</html>