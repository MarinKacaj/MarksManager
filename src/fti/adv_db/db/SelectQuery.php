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
    protected $projection;
    /**
     * @var string
     */
    protected $tableNames;

    /**
     * @param string[] $colNames
     * @param string[] $tableNames
     * @param string[] $filters
     */
    public function __construct($colNames, $tableNames, $filters = array())
    {
        $this->db = new DefaultDatabase();

        $colNames = $this->db->sanitizeNameValuePairs($colNames);
        $tableNames = $this->db->sanitizeNameValuePairs($tableNames);
        $filters = $this->db->sanitizeNameValuePairs($filters);

        $this->projection = (empty($colNames)) ? '*' : QueryPartsBuilder::buildCSVString($colNames);
        $this->tableNames = QueryPartsBuilder::buildCSVString($tableNames);
        $this->buildConjunctionWhereClause($filters);
    }


    /**
     * @return string
     */
    public function getQuery()
    {
        $selection = trim($this->selection);
        if (empty($selection)) {
            $query = "SELECT {$this->projection} FROM {$this->tableNames}";
        } else {
            $query = "SELECT {$this->projection} FROM {$this->tableNames} WHERE {$this->selection}";
        }
        return $query;
    }


}