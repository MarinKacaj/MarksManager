<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/28/2015
 * Time: 11:16 PM
 */

namespace fti\adv_db\db;


use fti\adv_db\db\util\QueryPartsBuilder;
use fti\adv_db\entity\AcademicYear;
use fti\adv_db\entity\Attendance;
use fti\adv_db\entity\Department;
use fti\adv_db\entity\Exam;
use fti\adv_db\entity\ExamResult;
use fti\adv_db\entity\Group;
use fti\adv_db\entity\Professor;
use fti\adv_db\entity\Result;
use fti\adv_db\entity\Season;
use fti\adv_db\entity\Student;
use fti\adv_db\entity\Subject;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class ExamResultQuery
 * @package fti\adv_db\db
 */
class ExamResultQuery extends SelectQuery
{

    /**
     * @var string
     */
    private $profMembersQueryPart;

    /**
     * @param int $seasonID
     * @param int $subjectID
     * @param int $groupID
     * @param int $professorID
     * @param bool $isImprovement
     */
    function __construct($seasonID, $subjectID, $groupID, $professorID, $isImprovement)
    {
        $this->db = new DefaultDatabase();

        $seasonID = intval($seasonID);
        $subjectID = intval($subjectID);
        $groupID = intval($groupID);
        $professorID = intval($professorID);
        $isImprovement = (bool)$isImprovement;

        $colNames = array(
            QueryPartsBuilder::buildColName(Student::TABLE_NAME, Student::PROP_ID . ' AS ' . ExamResult::PROP_STUDENT_ID),
            QueryPartsBuilder::buildColName(Student::TABLE_NAME, Student::PROP_FIRST_NAME),
            QueryPartsBuilder::buildColName(Student::TABLE_NAME, Student::PROP_LAST_NAME),
            QueryPartsBuilder::buildColName(Result::TABLE_NAME, Result::PROP_DATE),
            QueryPartsBuilder::buildColName(Result::TABLE_NAME, Result::PROP_MARK),
            QueryPartsBuilder::buildColName(Group::TABLE_NAME, Group::PROP_NAME),
            QueryPartsBuilder::buildColName(Department::TABLE_NAME, Department::PROP_NAME),
            QueryPartsBuilder::buildColName(AcademicYear::TABLE_NAME, AcademicYear::PROP_YEAR),
            QueryPartsBuilder::buildColName(Subject::TABLE_NAME, Subject::PROP_NAME),
            QueryPartsBuilder::buildColName(Exam::TABLE_NAME, Exam::PROP_ID . ' AS ' . ExamResult::PROP_EXAM_ID),
            QueryPartsBuilder::buildColName(Exam::TABLE_NAME, Exam::PROP_HEAD_ID),
            QueryPartsBuilder::buildColName(Exam::TABLE_NAME, Exam::PROP_MEMBER1_ID),
            QueryPartsBuilder::buildColName(Exam::TABLE_NAME, Exam::PROP_MEMBER2_ID)
        );
        $this->projection = QueryPartsBuilder::buildCSVString($colNames);

        $tableNames = array(
            AcademicYear::TABLE_NAME, Season::TABLE_NAME, Group::TABLE_NAME, Subject::TABLE_NAME, Professor::TABLE_NAME,
            Exam::TABLE_NAME, Student::TABLE_NAME, Department::TABLE_NAME, Result::TABLE_NAME, Attendance::TABLE_NAME
        );
        $this->tableNames = QueryPartsBuilder::buildCSVString($tableNames);

        $filters = array(
            QueryPartsBuilder::buildColName(Group::TABLE_NAME, Group::PROP_ID) => $groupID,
        );
        $this->buildConjunctionWhereClause($filters);
        $this->appendAndFilter(QueryPartsBuilder::buildColName(Result::TABLE_NAME, Result::PROP_EXAM_ID), QueryPartsBuilder::buildColName(Exam::TABLE_NAME, Exam::PROP_ID), true);
        $this->appendAndFilter(QueryPartsBuilder::buildColName(Result::TABLE_NAME, Result::PROP_STUDENT_ID), QueryPartsBuilder::buildColName(Student::TABLE_NAME, Student::PROP_ID), true);
        $this->appendAndFilter(QueryPartsBuilder::buildColName(Student::TABLE_NAME, Student::PROP_GROUP_ID), QueryPartsBuilder::buildColName(Group::TABLE_NAME, Group::PROP_ID), true);

        $this->appendAndFilter(QueryPartsBuilder::buildColName(Exam::TABLE_NAME, Exam::PROP_SEASON_ID), QueryPartsBuilder::buildColName(Season::TABLE_NAME, Season::PROP_ID), true);
        $this->appendAndFilter(QueryPartsBuilder::buildColName(Season::TABLE_NAME, Season::PROP_ID), $seasonID);

        $this->appendAndFilter(QueryPartsBuilder::buildColName(Exam::TABLE_NAME, Exam::PROP_SUBJECT_ID), QueryPartsBuilder::buildColName(Subject::TABLE_NAME, Subject::PROP_ID), true);
        $this->appendAndFilter(QueryPartsBuilder::buildColName(Subject::TABLE_NAME, Subject::PROP_ID), $subjectID);
        $this->appendAndFilter(QueryPartsBuilder::buildColName(Professor::TABLE_NAME, Professor::PROP_ID), $professorID);
        $this->appendAndFilter(QueryPartsBuilder::buildColName(Attendance::TABLE_NAME, Attendance::PROP_SUBJECT_ID), QueryPartsBuilder::buildColName(Subject::TABLE_NAME, Subject::PROP_ID), true);
        $this->appendAndFilter(QueryPartsBuilder::buildColName(Attendance::TABLE_NAME, Attendance::PROP_ASSIGNMENT), '1');
        $this->appendAndFilter(QueryPartsBuilder::buildColName(Attendance::TABLE_NAME, Attendance::PROP_LAB), '1');
        $this->appendAndFilter(QueryPartsBuilder::buildColName(Attendance::TABLE_NAME, Attendance::PROP_SEMINARIES), '1');
        $this->appendAndFilter(QueryPartsBuilder::buildColName(Attendance::TABLE_NAME, Attendance::PROP_STATUS), $isImprovement ? '1' : '0');

        $this->appendAndFilter(QueryPartsBuilder::buildColName(Exam::TABLE_NAME, Exam::PROP_HEAD_ID), $professorID);
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        $query = "SELECT {$this->projection} FROM {$this->tableNames} WHERE {$this->selection}";
        return $query;
    }


}