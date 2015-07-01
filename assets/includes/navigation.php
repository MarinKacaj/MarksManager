<?php
/**
 * Created by PhpStorm.
 * User: Ina Qirko
 * Date: 6/21/2015
 * Time: 9:00 PM
 */

require_once dirname(__FILE__) . '/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/http_utils.php';

$baseURL = get_assets_base_url();
$loggedInUser = getCurrentlyLoggedInUser();

?>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
            <span style="color: #269abc;">UPT </span>MarksManager
        </a>
    </div>
    <!-- /.navbar-header -->

    <?php if (isLogInActive()) : ?>
        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?php echo $loggedInUser->getDisplayName(); ?> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="<?php echo $baseURL . 'personal/changePasswordView.php' ?>">
                            <i class="fa fa-gear fa-fw"></i> Ndryshoni fjal&euml;kalimin
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="<?php echo $baseURL . 'auth/logout.php'; ?>"><i class="fa fa-sign-out fa-fw"></i> Dilni</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
    <?php endif; ?>

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <?php require_once dirname(__FILE__) . '/menuResolver.php'; ?>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>

<script type="text/javascript" src="<?php echo $baseURL; ?>js/sb-admin-2.js"></script>