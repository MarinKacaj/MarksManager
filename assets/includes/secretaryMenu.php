<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/23/2015
 * Time: 9:24 PM
 */

require_once dirname(__FILE__) . '/session.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/constants/gen_purpose.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/http_utils.php';

$baseURL = get_assets_base_url();
$listDefaultFileName = LIST_DEFAULT_FILE_NAME;
$createDefaultFileName = CREATE_DEFAULT_FILE_NAME;

?>

<li>
    <a href="<?php echo $baseURL . "university/$listDefaultFileName"; ?>">
        <i class="fa fa-university fa-fw"></i>
        Universitet
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . "faculty/$listDefaultFileName"; ?>">
        <i class="fa fa-shield fa-fw"></i>
        Fakultet
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . "department/$listDefaultFileName"; ?>">
        <i class="fa fa-sitemap fa-fw"></i>
        Deg&euml;
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . "group/$listDefaultFileName"; ?>">
        <i class="fa fa-group fa-fw"></i>
        Grup
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . "professor/$listDefaultFileName"; ?>">
        <i class="fa fa-user fa-fw"></i>
        Pedagog
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . "student/$listDefaultFileName"; ?>">
        <i class="fa fa-male fa-fw"></i>
        Student
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . "subject/$listDefaultFileName"; ?>">
        <i class="fa fa-book fa-fw"></i>
        L&euml;nd&euml;
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . "exam/$listDefaultFileName"; ?>">
        <i class="fa fa-files-o fa-fw"></i>
        Provim
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . "season/$listDefaultFileName"; ?>">
        <i class="fa fa-calendar-o fa-fw"></i>
        Sezon
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . "academicYear/$listDefaultFileName"; ?>">
        <i class="fa fa-calendar fa-fw"></i>
        Vit Akademik
    </a>
</li>