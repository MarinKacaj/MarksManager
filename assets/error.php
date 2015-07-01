<?php

use fti\adv_db\entity\Professor;
use fti\adv_db\entity\Secretary;
use fti\adv_db\entity\Student;

require_once dirname(__FILE__) . '/includes/loader.php';

$baseURL = get_assets_base_url();
$path = '';
$actor = $_SESSION[LOGGED_IN_USER_ROLE];
switch ($actor) {
    case Student::TABLE_NAME:
        $path = $baseURL . 'studentResults/list.php';
        break;
    case Professor::TABLE_NAME:
        $path = $baseURL . 'result/filter.php';
        break;
    case Secretary::TABLE_NAME:
        $path = $baseURL . 'university/list.php';
        break;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Logged in: Profesor filani</title>

    <meta name="viewport" content="width = device-width, initial-scale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="fonts/fontawesome-webfont.ttf" rel="stylesheet">

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</head>
<body>
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="error-template">
                <img class="center-block" src="img/fella-not-found.png">
                <h1></h1>
                <h2>Problem i p&euml;rkohsh&euml;m teknik</h2>
                <div class="error-details">
                    Keni hasur nj&euml; defekt teknik. Kontaktoni administrator&euml;t.
                </div>
                <div class="error-actions">
                    <a href="<?php echo $path; ?>" class="btn btn-primary btn-lg"><span class="fa fa-home"></span>
                        Kthehuni mbrapa
                    </a>
                    <a href="mailto:axhuvani@fti.edu.al" class="btn btn-default btn-lg"><span class="fa fa-envelope-o"></span>
                        Kontaktoni mir&euml;mbajtjen
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>