<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/14/2015
 * Time: 12:33 PM
 */

namespace fti\adv_db\db;


use fti\adv_db\db\util\QueryPartsBuilder;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class UpdateQuery
 * @package fti\adv_db\db
 */
class UpdateQuery extends CurrentDataQuery
{

    /**
     * @var string
     */
    private $tableName;
    /**
     * @var array
     */
    private $nameValuePairs;

    /**
     * @param string $tableName
     * @param array $nameValuePairs
     * @param array $filters
     */
    function __construct($tableName, $nameValuePairs, $filters)
    {
        $this->db = new DefaultDatabase();

        $this->tableName = $tableName;

        $sanitizedNameValuePairs = array();
        foreach ($nameValuePairs as $name => $value) {
            $name = $this->db->escape($name);
            $value = $this->db->escape($value);
            $sanitizedNameValuePairs[$name] = $value;
        }
        unset($name);
        unset($value);
        $this->nameValuePairs = $sanitizedNameValuePairs;
        $this->buildConjunctionWhereClause($filters);
    }


    /**
     * @return string
     */
    public function getQuery()
    {
        $setQueryPart = QueryPartsBuilder::buildNameValuePairStrings($this->nameValuePairs);
        $setQueryPart = QueryPartsBuilder::buildCSVString($setQueryPart);
        $selection = trim($this->selection);
        if (empty($selection)) {
            $query = "UPDATE {$this->tableName} SET $setQueryPart";
        } else {
            $query = "UPDATE {$this->tableName} SET $setQueryPart WHERE {$this->selection}";
        }
        return $query;
    }


}