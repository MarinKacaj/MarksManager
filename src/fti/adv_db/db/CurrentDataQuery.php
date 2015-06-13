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
     * @param string $booleanOperand [optional]
     */
    private function appendFilter($colName, $value, $booleanOperand = '')
    {
        $filterToAppend = ' ' . $booleanOperand . ' ' . $colName . '=' . $value;
        $this->selection .= $filterToAppend;
    }

    /**
     * @param string $colName
     * @param string $value
     */
    public function appendFirstFilter($colName, $value)
    {
        $this->appendFilter($colName, $value);
    }

    /**
     * @param string $colName
     * @param string $value
     */
    public function appendAndFilter($colName, $value)
    {
        $this->appendFilter($colName, $value, 'AND');
    }

    /**
     * @param string $colName
     * @param string $value
     */
    public function appendOrFilter($colName, $value)
    {
        $this->appendFilter($colName, $value, 'OR');
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