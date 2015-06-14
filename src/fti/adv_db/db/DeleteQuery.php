<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/14/2015
 * Time: 3:43 PM
 */

namespace fti\adv_db\db;


require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class DeleteQuery
 * @package fti\adv_db\db
 */
class DeleteQuery extends CurrentDataQuery
{

    /**
     * @var string
     */
    private $tableName;

    /**
     * @param string $tableName
     * @param array $filters
     */
    function __construct($tableName, $filters)
    {
        $this->db = new DefaultDatabase();
        $filters = $this->db->sanitizeNameValuePairs($filters);

        $this->tableName = $tableName;
        $this->buildConjunctionWhereClause($filters);
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        $selection = trim($this->selection);
        if (empty($selection)) {
            $query = "DELETE FROM {$this->tableName}";
        } else {
            $query = "DELETE FROM {$this->tableName} WHERE $selection";
        }
        return $query;
    }


}