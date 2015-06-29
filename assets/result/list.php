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

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/gen_purpose.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

redirectIfNotProfessor();

$currentlyLoggedInProfessor = getCurrentlyLoggedInUser();
$professorID = $currentlyLoggedInProfessor->getProperty(Professor::PROP_ID)->getValue();
$filters = HttpEntityParamBuilder::retrieveFilter(array(Season::TABLE_NAME, Subject::TABLE_NAME, Group::TABLE_NAME));
$seasonID = intval($filters[Season::TABLE_NAME]);
$subjectID = intval($filters[Subject::TABLE_NAME]);
$groupID = intval($filters[Group::TABLE_NAME]);
$isImprovement = isset($_GET[RESULT_IS_FOR_IMPROVEMENT]) ? true : false;

$examResultInstances = ExamResult::getFilteredList($seasonID, $subjectID, $groupID, $professorID, $isImprovement);
$isEmpty = false;
if (empty($examResultInstances)) {
    $isEmpty = true;
    array_push($examResultInstances, ExamResult::getBuilder()->createEmpty());
}
$listViewAggregator = new ListViewAggregator($examResultInstances);

?>

<!DOCTYPE html>
<html>
<?php require_once dirname(dirname(__FILE__)) . '/includes/head.php'; ?>
<body>
<?php require_once dirname(dirname(__FILE__)) . '/includes/navigation.php'; ?>
<div class="container">
    <div class="well text-center" id="mainTitle"><h4>Rezultatet</h4></div>
    <div class="row">
        <div id="listaVleresoStudente" class="col-sm-12">
            <?php echo $listViewAggregator->buildListHTML($isEmpty); ?>
            <a href="filter.php">
                <button class="btn btn-default">Kthehu te filtri</button>
            </a>
        </div>
    </div>
</div>
</body>
</html>
