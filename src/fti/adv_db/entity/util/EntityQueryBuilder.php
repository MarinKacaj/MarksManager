<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/12/2015
 * Time: 4:18 PM
 */

namespace fti\adv_db\entity;


use fti\adv_db\db\SelectQuery;

require_once dirname(dirname(dirname(__FILE__))) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

class EntityQueryBuilder
{

    /**
     * @param Entity $entityInstance
     * @return Entity[]
     */
    public static function retrieveList($entityInstance)
    {
        $entityInstancesList = array();

        $tableNames = array($entityInstance->getTableName());
        $colNames = array_keys($entityInstance->getProperties());
        $selectQuery = new SelectQuery($colNames, $tableNames);

        $listResult = $selectQuery->exec();
        while (($params = $listResult->fetch_assoc()) !== NULL) {
            $retrievedEntityInstance = $entityInstance->create($params);
            array_push($entityInstancesList, $retrievedEntityInstance);
        }

        return $entityInstancesList;
    }
}