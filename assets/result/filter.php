<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/28/2015
 * Time: 9:57 PM
 */

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

redirectIfNotProfessor();

?>

<!DOCTYPE html>
<html>
<?php require_once dirname(dirname(__FILE__)) . '/includes/head.php'; ?>
<body>
<?php require_once dirname(dirname(__FILE__)) . '/includes/navigation.php'; ?>
<div class="container">
    <div class="well text-center" id="mainTitle"><h4>Filtro rezultatet</h4></div>
    <form class="form-horizontal" action="list.php" method="get">

    </form>
</div>
</body>
</html>
