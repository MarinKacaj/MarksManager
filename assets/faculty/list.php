<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/19/2015
 * Time: 1:07 AM
 */

use fti\adv_db\aggregator\ListViewAggregator;
use fti\adv_db\entity\Faculty;

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

redirectIfNotSecretary();


$facultyInstances = Faculty::getBuilder()->getList();
$isEmpty = false;
if (empty($facultyInstances)) {
    $isEmpty = true;
    array_push($facultyInstances, Faculty::getBuilder()->createEmpty());
}
$listViewAggregator = new ListViewAggregator($facultyInstances);
?>

<!DOCTYPE html>
<html>
<?php require_once dirname(dirname(__FILE__)) . '/includes/head.php'; ?>
<body>
<?php require_once dirname(dirname(__FILE__)) . '/includes/navigation.php'; ?>
<div class="container">
    <div class="well text-center" id="mainTitle"><h4>Fakultete</h4></div>
    <div class="row">
        <div id="listaVleresoStudente" class="col-sm-12">
            <?php echo $listViewAggregator->buildListHTML($isEmpty); ?>
        </div>
    </div>
</div>
</body>
</html>