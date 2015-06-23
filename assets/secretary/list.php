<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/19/2015
 * Time: 1:07 AM
 */

use fti\adv_db\aggregator\ListViewAggregator;
use fti\adv_db\entity\Secretary;

require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');


$secretaryInstances = Secretary::getBuilder()->getList();
$isEmpty = false;
if (empty($secretaryInstances)) {
    $isEmpty = true;
    array_push($secretaryInstances, Secretary::getBuilder()->createEmpty());
}
$listViewAggregator = new ListViewAggregator($secretaryInstances);
?>

<!DOCTYPE html>
<html>
<?php require_once dirname(dirname(__FILE__)) . '/includes/head.php'; ?>
<body>
<?php require_once dirname(dirname(__FILE__)) . '/includes/navigation.php'; ?>
<div class="container">
    <div class="well text-center" id="mainTitle"><h4>TITULL</h4></div>
    <div class="row">
        <div id="listaVleresoStudente" class="col-sm-12">
            <?php echo $listViewAggregator->buildListHTML($isEmpty); ?>
        </div>
    </div>
</div>
</body>
</html>
