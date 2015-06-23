<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/8/2015
 * Time: 6:14 PM
 */

use fti\adv_db\aggregator\FormViewAggregator;
use fti\adv_db\entity\Student;

require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');


$studentInstance = Student::getBuilder()->createEmpty();
$formViewAggregator = new FormViewAggregator($studentInstance);

?>

<!DOCTYPE html>
<html>
<?php require_once dirname(dirname(__FILE__)) . '/includes/head.php'; ?>
<body>
<?php require_once dirname(dirname(__FILE__)) . '/includes/navigation.php'; ?>
<div class="container">
    <div class="well text-center" id="mainTitle"><h4>Krijo Student</h4></div>
    <?php echo $formViewAggregator->buildEntityFormHTML(); ?>
</div>
</body>
</html>