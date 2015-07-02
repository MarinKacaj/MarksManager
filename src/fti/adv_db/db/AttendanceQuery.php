<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 7/3/2015
 * Time: 1:15 AM
 */

namespace fti\adv_db\db;


use fti\adv_db\db\util\QueryPartsBuilder as QBuilder;
use fti\adv_db\entity\Attendance;
use fti\adv_db\entity\Exam;
use fti\adv_db\entity\Subject;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class AttendanceQuery
 * @package fti\adv_db\db
 */
class AttendanceQuery extends SelectQuery
{


    /**
     * @param int $professorID
     */
    function __construct($professorID)
    {
        $this->db = new DefaultDatabase();

        $professorID = intval($professorID);

        $colNames = array(QBuilder::buildColName(Attendance::TABLE_NAME, '*'));
        $this->projection = QBuilder::buildCSVString($colNames);

        $tableNames = array(Attendance::TABLE_NAME, Subject::TABLE_NAME, Exam::TABLE_NAME);
        $this->tableNames = QBuilder::buildCSVString($tableNames);

        $filters = array(QBuilder::buildColName(Exam::TABLE_NAME, Exam::PROP_HEAD_ID) => $professorID);
        $this->buildConjunctionWhereClause($filters);
        $this->appendAndFilter(QBuilder::buildColName(Attendance::TABLE_NAME, Attendance::PROP_SUBJECT_ID), QBuilder::buildColName(Subject::TABLE_NAME, Subject::PROP_ID), true);
        $this->appendAndFilter(QBuilder::buildColName(Subject::TABLE_NAME, Subject::PROP_ID), QBuilder::buildColName(Exam::TABLE_NAME, Exam::PROP_SUBJECT_ID), true);
    }


}