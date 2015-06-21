<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 6/12/2015
 * Time: 10:47 AM
 */

namespace fti\adv_db\http;


use fti\adv_db\entity\BasicEntity;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';
require_once dirname(dirname(__FILE__)) . '/functions/http_utils.php';

spl_autoload_register('class_auto_loader');

/**
 * Class HttpEntityParamBuilder
 * @package fti\adv_db\http
 */
class HttpEntityParamBuilder
{

    /**
     * @return array
     */
    public static function buildParams()
    {
        $params = array_merge($_POST, $_GET);
        return $params;
    }

    /**
     * @param string $basename
     * @param array $params
     * @return string
     */
    public static function buildArgumentsRelativePath($basename, $params)
    {
        $queryStr = http_build_str($params);
        $argumentsRelativePath = $basename . '?' . $queryStr;
        return $argumentsRelativePath;
    }

    /**
     * @param array $primaryKeyColNames
     * @return array
     */
    public static function retrieveIdentifier($primaryKeyColNames)
    {
        $identifier = array();
        foreach ($primaryKeyColNames as $primaryKeyColName) {
            $id = intval($_GET[$primaryKeyColName]);
            $identifier[$primaryKeyColName] = $id;
        }
        unset($primaryKeyColName);
        return $identifier;
    }

    /**
     * @param BasicEntity $entityInstance
     * @return string
     */
    public static function buildFormAction($entityInstance)
    {
        $identifier = $entityInstance->getIdentifier();
        if (in_array(BasicEntity::UNSAVED_INSTANCE_ID, $identifier)) {
            $action = SAVE_DEFAULT_FILE_NAME;
        } else {
            $action = HttpEntityParamBuilder::buildArgumentsRelativePath(
                UPDATE_DEFAULT_FILE_NAME,
                $identifier
            );
        }
        return $action;
    }


}