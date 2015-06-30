<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/12/2015
 * Time: 3:35 PM
 */

namespace fti\adv_db\db;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class CurrentDataQuery
 * @package fti\adv_db\db
 */
abstract class CurrentDataQuery extends BasicQuery
{

    /**
     * @var string
     */
    protected $selection;

    /**
     * @param string $colName
     * @param string $value
     * @param bool $isValueColName
     * @param string $booleanOperand [optional]
     */
    private function appendFilter($colName, $value, $isValueColName, $booleanOperand = '')
    {
        if (!is_numeric($value) && is_string($value) && !$isValueColName) {
            $value = "'$value'";
        }
        $filterToAppend = ' ' . $booleanOperand . ' ' . $colName . '=' . $value;
        $this->selection .= $filterToAppend;
    }

    /**
     * @param string $colName
     * @param string $value
     * @param bool $isValueColName
     */
    public function appendFirstFilter($colName, $value, $isValueColName = false)
    {
        $this->appendFilter($colName, $value, $isValueColName);
    }

    /**
     * @param string $colName
     * @param string $value
     * @param bool $isValueColName [optional]
     */
    public function appendAndFilter($colName, $value, $isValueColName = false)
    {
        $this->appendFilter($colName, $value, $isValueColName, 'AND');
    }

    /**
     * @param string $colName
     * @param string $value
     * @param bool $isValueColName [optional]
     */
    public function appendOrFilter($colName, $value, $isValueColName = false)
    {
        $this->appendFilter($colName, $value, $isValueColName, 'OR');
    }

    /**
     * @param string[] $filters
     */
    public function buildConjunctionWhereClause($filters)
    {
        $isFirstFilter = true;
        foreach ($filters as $name => $value) {
            if ($isFirstFilter) {
                $this->appendFirstFilter($name, $value);
                $isFirstFilter = false;
            } else {
                $this->appendAndFilter($name, $value);
            }
        }
        unset($name);
        unset($value);
    }
}