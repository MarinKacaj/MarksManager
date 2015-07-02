<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/13/2015
 * Time: 7:29 PM
 */

use fti\adv_db\entity\Result;
use fti\adv_db\exceptions\MySQLException;
use fti\adv_db\http\HttpEntityParamBuilder;

require_once dirname(dirname(__FILE__)) . '/includes/session.php';
require_once dirname(dirname(__FILE__)) . '/auth/security.php';
require_once dirname(dirname(dirname(__FILE__))) . '/src/fti/adv_db/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

redirectIfNotProfessor();

/**
 * @param int $errorCode
 * @param string $previousURL
 * @return string
 */
function build_error_path($errorCode, $previousURL)
{
    $path = EDIT_DEFAULT_FILE_NAME;
    $args = http_build_str(array(
        REPORT_CODE => $errorCode,
        PREVIOUS_URL => $previousURL
    ));
    $path = $path . '?' . $args;
    return $path;
}

$identifier = HttpEntityParamBuilder::retrieveFilter(array(Result::PROP_EXAM_ID, Result::PROP_STUDENT_ID));
$currentResultInstance = Result::getBuilder()->getByIdentifier($identifier);

$params = HttpEntityParamBuilder::buildParams();
$resultInstance = new Result($params);

$listURL = $_GET[PREVIOUS_URL];
$listURL = urldecode($listURL);

try {
    if ($currentResultInstance) {
        $resultInstance->update();
    } else {
        $resultInstance->save();
    }
    header("Location: $listURL");
} catch (InvalidArgumentException $e) {
    $path = build_error_path($e->getCode(), $listURL);
    header("Location: $path");
} catch (MySQLException $e) {
    $path = build_error_path($e->getCode(), $listURL);
    header("Location: $path");
}