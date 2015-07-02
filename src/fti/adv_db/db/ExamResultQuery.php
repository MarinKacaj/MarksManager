<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/28/2015
 * Time: 11:16 PM
 */

namespace fti\adv_db\db;


use fti\adv_db\db\util\QueryPartsBuilder as QBuilder;
use fti\adv_db\entity\AcademicYear;
use fti\adv_db\entity\Attendance;
use fti\adv_db\entity\Department;
use fti\adv_db\entity\Exam;
use fti\adv_db\entity\ExamResult;
use fti\adv_db\entity\Group;
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
        $isImprovement = (bool) $isImprovement;

        $colNames = array(
            QBuilder::buildColName(Student::TABLE_NAME, Student::PROP_ID . ' AS ' . ExamResult::PROP_STUDENT_ID),
            QBuilder::buildColName(Student::TABLE_NAME, Student::PROP_FIRST_NAME),
            QBuilder::buildColName(Student::TABLE_NAME, Student::PROP_LAST_NAME),
            QBuilder::buildColName(Result::TABLE_NAME, Result::PROP_DATE),
            QBuilder::buildColName(Result::TABLE_NAME, Result::PROP_MARK),
            QBuilder::buildColName(Group::TABLE_NAME, Group::PROP_NAME),
            QBuilder::buildColName(Department::TABLE_NAME, Department::PROP_NAME),
            QBuilder::buildColName(AcademicYear::TABLE_NAME, AcademicYear::PROP_YEAR),
            QBuilder::buildColName(Subject::TABLE_NAME, Subject::PROP_NAME),
            QBuilder::buildColName(Exam::TABLE_NAME, Exam::PROP_ID . ' AS ' . ExamResult::PROP_EXAM_ID),
            QBuilder::buildColName(Exam::TABLE_NAME, Exam::PROP_HEAD_ID),
            QBuilder::buildColName(Exam::TABLE_NAME, Exam::PROP_MEMBER1_ID),
            QBuilder::buildColName(Exam::TABLE_NAME, Exam::PROP_MEMBER2_ID)
        );
        $this->projection = QBuilder::buildCSVString($colNames);

        $tableNames = array(
            AcademicYear::TABLE_NAME
        );
        $this->tableNames = QBuilder::buildCSVString($tableNames);
        $this->joinTableWith(Group::TABLE_NAME, QBuilder::buildColEq(AcademicYear::TABLE_NAME, AcademicYear::PROP_ID, Group::TABLE_NAME, Group::PROP_START_AY_ID));
        $this->joinTableWith(Student::TABLE_NAME, QBuilder::buildColEq(Group::TABLE_NAME, Group::PROP_ID, Student::TABLE_NAME, Student::PROP_GROUP_ID));
        $this->joinTableWith(Department::TABLE_NAME, QBuilder::buildColEq(Department::TABLE_NAME, Department::PROP_ID, Group::TABLE_NAME, Group::PROP_DEPARTMENT_ID));
        $this->joinTableWith(Exam::TABLE_NAME, QBuilder::buildColEq(Department::TABLE_NAME, Department::PROP_ID, Exam::TABLE_NAME, Exam::PROP_DEPARTMENT_ID));
        $this->joinTableWith(Season::TABLE_NAME, QBuilder::buildColEq(Season::TABLE_NAME, Season::PROP_ID, Exam::TABLE_NAME, Exam::PROP_SEASON_ID));
        $this->joinTableWith(Subject::TABLE_NAME, QBuilder::buildColEq(Subject::TABLE_NAME, Subject::PROP_ID, Exam::TABLE_NAME, Exam::PROP_SUBJECT_ID));
        $attendanceSubjectFilter = QBuilder::buildColEq(Subject::TABLE_NAME, Subject::PROP_ID, Attendance::TABLE_NAME, Attendance::PROP_SUBJECT_ID);
        $attendanceStudentFilter = QBuilder::buildColEq(Student::TABLE_NAME, Student::PROP_ID, Attendance::TABLE_NAME, Attendance::PROP_STUDENT_ID);
        $this->joinTableWith(Attendance::TABLE_NAME, $attendanceStudentFilter . ' AND ' . $attendanceSubjectFilter);
        $resultStudentFilter = QBuilder::buildColEq(Student::TABLE_NAME, Student::PROP_ID, Result::TABLE_NAME, Result::PROP_STUDENT_ID);
        $resultExamFilter = QBuilder::buildColEq(Exam::TABLE_NAME, Exam::PROP_ID, Result::TABLE_NAME, Result::PROP_EXAM_ID);
        $this->joinTableWith(Result::TABLE_NAME, $resultExamFilter . ' AND ' . $resultStudentFilter, 'LEFT JOIN');

        $filters = array(
            QBuilder::buildColName(Group::TABLE_NAME, Group::PROP_ID) => $groupID,
        );
        $this->buildConjunctionWhereClause($filters);

        $this->appendAndFilter(QBuilder::buildColName(Season::TABLE_NAME, Season::PROP_ID), $seasonID);
        $this->appendAndFilter(QBuilder::buildColName(Subject::TABLE_NAME, Subject::PROP_ID), $subjectID);

        $this->appendAndFilter(QBuilder::buildColName(Attendance::TABLE_NAME, Attendance::PROP_ASSIGNMENT), '1');
        $this->appendAndFilter(QBuilder::buildColName(Attendance::TABLE_NAME, Attendance::PROP_LAB), '1');
        $this->appendAndFilter(QBuilder::buildColName(Attendance::TABLE_NAME, Attendance::PROP_SEMINARIES), '1');
        $this->appendAndFilter(QBuilder::buildColName(Attendance::TABLE_NAME, Attendance::PROP_STATUS), $isImprovement ? '1' : '0');

        $this->appendAndFilter(QBuilder::buildColName(Exam::TABLE_NAME, Exam::PROP_HEAD_ID), $professorID);
    }


    /**
     * @param string $tableName
     * @param string $condition
     * @param string $joinKeyword [optional]
     */
    public function joinTableWith($tableName, $condition, $joinKeyword = 'INNER JOIN')
    {
        $joinClause = " $joinKeyword $tableName ON $condition";
        $this->tableNames .= $joinClause;
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