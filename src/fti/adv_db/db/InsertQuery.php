<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/14/2015
 * Time: 1:09 AM
 */

namespace fti\adv_db\db;


use fti\adv_db\db\util\QueryPartsBuilder;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class InsertQuery
 * @package fti\adv_db\db
 */
class InsertQuery extends BasicQuery
{

    /**
     * @var string
     */
    private $tableName;
    /**
     * @var string[]
     */
    private $colNames;
    /**
     * @var array
     */
    private $values;

    /**
     * @param string $tableName
     * @param array $nameValuePairs
     */
    function __construct($tableName, $nameValuePairs)
    {
        $this->db = new DefaultDatabase();

        $this->tableName = $this->db->escape($tableName);
        $this->colNames = array();
        $this->values = array();

        foreach ($nameValuePairs as $name => $value) {

            $name = $this->db->escape($name);
            $value = $this->db->escape($value);

            array_push($this->colNames, $name);
            if (is_numeric($value)) {
                array_push($this->values, $value);
            } else {
                array_push($this->values, "'$value'");
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
        $colNames = QueryPartsBuilder::buildCSVString($this->colNames);
        $values = QueryPartsBuilder::buildCSVString($this->values);
        $query = "INSERT INTO {$this->tableName} ($colNames) VALUES ($values)";
        return $query;
    }

    /**
     * @return mixed
     */
    public function getLastInsertedID()
    {
        return $this->db->getLastInsertedID();
    }


}