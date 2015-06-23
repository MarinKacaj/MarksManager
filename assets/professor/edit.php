<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/14/2015
 * Time: 2:05 PM
 */

use fti\adv_db\aggregator\FormViewAggregator;
use fti\adv_db\entity\Professor;
use fti\adv_db\http\HttpEntityParamBuilder;

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');


$identifier = HttpEntityParamBuilder::retrieveIdentifier(array(Professor::PROP_ID));
$professorInstance = Professor::getBuilder()->getByIdentifier($identifier);
$formViewAggregator = new FormViewAggregator($professorInstance);

?>

<!DOCTYPE html>
<html>
<?php require_once dirname(dirname(__FILE__)) . '/includes/head.php'; ?>
<body>
<?php require_once dirname(dirname(__FILE__)) . '/includes/navigation.php'; ?>
<div class="container">
    <div class="well text-center" id="mainTitle"><h4>P&euml;rdit&euml;so gjeneralitetet e Profesorit</h4></div>
    <?php echo $formViewAggregator->buildEntityFormHTML(); ?>
</div>
</body>
</html>