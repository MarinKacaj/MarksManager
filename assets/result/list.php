<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/19/2015
 * Time: 1:07 AM
 */

use fti\adv_db\aggregator\ListViewAggregator;
use fti\adv_db\entity\Department;
use fti\adv_db\entity\Result;
use fti\adv_db\entity\Season;
use fti\adv_db\entity\Subject;
use fti\adv_db\http\HttpEntityParamBuilder;

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

redirectIfNotProfessor();


$seasonFilterName = Season::TABLE_NAME;
$subjectFilterName = Subject::TABLE_NAME;
$departmentFilterName = Department::TABLE_NAME;
$filterData = HttpEntityParamBuilder::retrieveFilter(array($seasonFilterName, $subjectFilterName, $departmentFilterName));
$resultInstances = Result::getBuilder()->filterList($filterData);
$isEmpty = false;
if (empty($resultInstances)) {
    $isEmpty = true;
    array_push($resultInstances, Result::getBuilder()->createEmpty());
}
$listViewAggregator = new ListViewAggregator($resultInstances);

?>

<!DOCTYPE html>
<html>
<?php require_once dirname(dirname(__FILE__)) . '/includes/head.php'; ?>
<body>
<?php require_once dirname(dirname(__FILE__)) . '/includes/navigation.php'; ?>
<div class="container">
    <div class="well text-center" id="mainTitle"><h4>Rezultate</h4></div>
    <div class="row">
        <div id="listaVleresoStudente" class="col-sm-12">
            <?php echo $listViewAggregator->buildListHTML($isEmpty); ?>
        </div>
    </div>
</div>
</body>
</html>
