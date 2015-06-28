<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/28/2015
 * Time: 12:03 AM
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
 * Class StudentResultQuery
 * @package fti\adv_db\db
 */
class StudentResultQuery extends SelectQuery
{

    /**
     * @var int
     */
    private $studentID;
    /**
     * @var string
     */
    private $latestExamTableAlias;

    /**
     * @param int $studentID
     */
    function __construct($studentID)
    {
        $this->db = new DefaultDatabase();

        $studentID = intval($this->db->escape($studentID));
        $this->studentID = $studentID;

        $colNames = array(
            Subject::TABLE_NAME . '.' . Subject::PROP_NAME,
            Result::TABLE_NAME . '.' . Result::PROP_MARK
        );
        $this->projection = QueryPartsBuilder::buildCSVString($colNames);

        $this->latestExamTableAlias = 'LatestExam';
        $latestExamQuery = new LatestExamQuery($studentID);
        $latestExamTableQuery = $latestExamQuery->getQuery();
        $latestExamTableQuery = "($latestExamTableQuery) AS {$this->latestExamTableAlias}";
        $tableNames = array(Subject::TABLE_NAME, Exam::TABLE_NAME, Result::TABLE_NAME, Student::TABLE_NAME,
            Group::TABLE_NAME, Department::TABLE_NAME, $latestExamTableQuery);
        $this->tableNames = QueryPartsBuilder::buildCSVString($tableNames);

        $filters = array(Exam::PROP_SUBJECT_ID => Subject::PROP_ID, Result::PROP_EXAM_ID => Exam::PROP_ID,
            Result::PROP_STUDENT_ID => $studentID, Student::PROP_GROUP_ID => Group::PROP_ID,
            Group::PROP_DEPARTMENT_ID => Exam::PROP_DEPARTMENT_ID,
            Subject::PROP_ID => $this->latestExamTableAlias . '.' . Subject::PROP_ID,
            $this->latestExamTableAlias . '.' . $latestExamQuery->getLastResultDateAlias() => Result::PROP_DATE
        );
        $this->buildConjunctionWhereClause($filters);
    }


    /**
     * @return string
     */
    public function getLatestExamTableAlias()
    {
        return $this->latestExamTableAlias;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        $query = "SELECT DISTINCT {$this->projection} FROM {$this->tableNames} WHERE {$this->selection}";
        return $query;
    }
}