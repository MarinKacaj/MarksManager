<?php
/**
 * Created by PhpStorm.
 * User: Ina Qirko
 * Date: 6/21/2015
 * Time: 8:36 PM
 */

require_once dirname(__FILE__) . '/session.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/http_utils.php';

$baseURL = get_assets_base_url();

?>

<head>
    <title>Logged in: Profesor filani</title>

    <meta name="viewport" content="width = device-width, initial-scale=1.0">
    <link href="<?php echo $baseURL; ?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $baseURL; ?>css/custom.css" rel="stylesheet">
    <link href="<?php echo $baseURL; ?>css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo $baseURL; ?>fonts/fontawesome-webfont.ttf" rel="stylesheet">

    <script src="<?php echo $baseURL; ?>js/jquery-1.11.0.min.js"></script>
    <script src="<?php echo $baseURL; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo $baseURL; ?>js/custom.js"></script>
</head>