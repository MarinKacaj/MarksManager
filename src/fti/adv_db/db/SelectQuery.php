<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/12/2015
 * Time: 2:01 PM
 */

namespace fti\adv_db\db;


use fti\adv_db\db\util\QueryPartsBuilder;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class SelectQuery
 * @package fti\adv_db\db
 */
class SelectQuery extends CurrentDataQuery
{

    /**
     * @var string
     */
    private $projection;
    /**
     * @var string
     */
    private $tableNames;

    /**
     * @param string[] $colNames
     * @param string[] $tableNames
     * @param string[] $filters
     */
    public function __construct($colNames, $tableNames, $filters = array())
    {
        $this->db = new DefaultDatabase();

        $this->projection = (empty($colNames)) ? '*' : QueryPartsBuilder::buildCSVString($colNames);
        $this->tableNames = QueryPartsBuilder::buildCSVString($tableNames);

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

    /**
     * @return string
     */
    public function getQuery()
    {
        return "SELECT {$this->projection} FROM {$this->tableNames} WHERE {$this->selection}";
    }


}