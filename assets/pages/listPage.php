<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 7/1/2015
 * Time: 12:11 AM
 */

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/http_utils.php';


$baseURL = get_assets_base_url();

$contentHeader = $GLOBALS[CONTENT_HEADER];
$contentAction = $GLOBALS[CONTENT_ACTION];
$contentHTML = $GLOBALS[CONTENT_HTML];

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