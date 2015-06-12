<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/12/2015
 * Time: 3:35 PM
 */

namespace fti\adv_db\db;

use fti\adv_db\db\util\QueryPartsBuilder;

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
     * @param string $booleanOperand
     * @param string $colName
     * @param string $value
     */
    private function appendFilter($booleanOperand, $colName, $value)
    {
        $filterToAppend = ' ' . $booleanOperand . ' ' . QueryPartsBuilder::buildNameValuePairStrings(array($colName => $value));
        $this->selection .= $filterToAppend;
    }

    /**
     * @param string $colName
     * @param string $value
     */
    public function appendAndFilter($colName, $value)
    {
        $this->appendFilter('AND', $colName, $value);
    }

    /**
     * @param string $colName
     * @param string $value
     */
    public function appendOrFilter($colName, $value)
    {
        $this->appendFilter('OR', $colName, $value);
    }
}