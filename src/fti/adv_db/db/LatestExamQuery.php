<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/28/2015
 * Time: 1:07 AM
 */

namespace fti\adv_db\db;

use fti\adv_db\db\util\QueryPartsBuilder;
use fti\adv_db\entity\Department;
use fti\adv_db\entity\Exam;
use fti\adv_db\entity\Group;
use fti\adv_db\entity\Result;
use fti\adv_db\entity\Student;
use fti\adv_db\entity\Subject;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class LatestExamQuery
 * @package fti\adv_db\db
 */
class LatestExamQuery extends SelectQuery
{

    /**
     * @var int
     */
    private $studentID;
    /**
     * @var string
     */
    private $lastResultDateAlias;

    /**
     * @param int $studentID
     */
    function __construct($studentID)
    {
        $this->db = new DefaultDatabase();

        $studentID = intval($this->db->escape($studentID));
        $this->studentID = $studentID;
        $this->lastResultDateAlias = 'LastResultDate';

        $resultDateFullyQualifiedColName = Result::TABLE_NAME . '.' . Result::PROP_DATE;
        $colNames = array(
            Subject::TABLE_NAME . '.' . Subject::PROP_ID,
            "MAX($resultDateFullyQualifiedColName) AS {$this->lastResultDateAlias}"
        );
        $this->projection = QueryPartsBuilder::buildCSVString($colNames);

        $tableNames = array(Subject::TABLE_NAME, Exam::TABLE_NAME, Result::TABLE_NAME,
            Student::TABLE_NAME, Group::TABLE_NAME, Department::TABLE_NAME);
        $this->tableNames = QueryPartsBuilder::buildCSVString($tableNames);

        $filters = array(
            Result::TABLE_NAME . '.' . Result::PROP_STUDENT_ID => $studentID,
        );
        $this->buildConjunctionWhereClause($filters);
        $this->appendAndFilter(Exam::TABLE_NAME . '.' . Exam::PROP_SUBJECT_ID, Subject::TABLE_NAME . '.' . Subject::PROP_ID, true);
        $this->appendAndFilter(Result::TABLE_NAME . '.' . Result::PROP_EXAM_ID, Exam::TABLE_NAME . '.' . Exam::PROP_ID, true);
        $this->appendAndFilter(Student::TABLE_NAME . '.' . Student::PROP_GROUP_ID, Group::TABLE_NAME . '.' . Group::PROP_ID, true);
        $this->appendAndFilter(Group::TABLE_NAME . '.' . Group::PROP_DEPARTMENT_ID, Exam::TABLE_NAME . '.' . Exam::PROP_DEPARTMENT_ID, true);
    }

    /**
     * @return string
     */
    public function getLastResultDateAlias()
    {
        return $this->lastResultDateAlias;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        $groupCol = Subject::PROP_ID;
        $query = "SELECT DISTINCT {$this->projection} FROM {$this->tableNames} WHERE {$this->selection} GROUP BY $groupCol";
        return $query;
    }


}