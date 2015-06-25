<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/14/2015
 * Time: 2:05 PM
 */

use fti\adv_db\aggregator\FormViewAggregator;
use fti\adv_db\entity\Result;
use fti\adv_db\http\HttpEntityParamBuilder;

require_once dirname(dirname(__FILE__)) . '/includes/session.php';

require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');


$identifier = HttpEntityParamBuilder::retrieveIdentifier(array(Result::PROP_EXAM_ID, Result::PROP_STUDENT_ID));;
$resultInstance = Result::getBuilder()->getByIdentifier($identifier);
$formViewAggregator = new FormViewAggregator($resultInstance);

?>

<!DOCTYPE html>
<html>
<?php require_once dirname(dirname(__FILE__)) . '/includes/head.php'; ?>
<body>
<?php require_once dirname(dirname(__FILE__)) . '/includes/navigation.php'; ?>
<div class="container">
    <div class="well text-center" id="mainTitle"><h4>P&euml;rdit&euml;so Rezultatin</h4></div>
    <?php echo $formViewAggregator->buildEntityFormHTML(); ?>
</div>
<?php require_once dirname(dirname(__FILE__)) . '/includes/date-picker-init.php'; ?>
</body>
</html>