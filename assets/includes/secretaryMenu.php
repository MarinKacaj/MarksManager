<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/23/2015
 * Time: 9:24 PM
 */

require_once dirname(__FILE__) . '/session.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/http_utils.php';

$baseURL = get_assets_base_url();

?>

<li>
    <a href="<?php echo $baseURL . 'academicYear/list.php' ?>">
        Vit Akademik
        <span class="sr-only">(current)</span>
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . 'university/list.php' ?>">
        Universitet
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . 'faculty/list.php' ?>">
        Fakultet
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . 'department/list.php' ?>">
        Deg&euml;
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . 'group/list.php' ?>">
        Grup
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . 'professor/list.php' ?>">
        Pedagog
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . 'student/list.php' ?>">
        Student
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . 'subject/list.php' ?>">
        L&euml;nd&euml;
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . 'exam/list.php' ?>">
        Provim
    </a>
</li>
<li>
    <a href="<?php echo $baseURL . 'season/list.php' ?>">
        Sezon
    </a>
</li>