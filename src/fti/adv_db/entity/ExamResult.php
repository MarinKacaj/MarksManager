<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/29/2015
 * Time: 1:49 AM
 */

namespace fti\adv_db\entity;


use fti\adv_db\db\ExamResultQuery;
use fti\adv_db\entity\util\EntityBuilderHelper;
use fti\adv_db\property\DateProperty;
use fti\adv_db\property\IntegerProperty;
use fti\adv_db\property\StringProperty;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class ExamResult
 * @package fti\adv_db\entity
 */
class ExamResult extends CompositeEntity
{

    const LABEL = 'Flet&euml; Provimi';
    const PROP_STUDENT_ID = Student::PROP_ID;
    const PROP_STUDENT_FIRST_NAME = Student::PROP_FIRST_NAME;
    const PROP_STUDENT_LAST_NAME = Student::PROP_LAST_NAME;
    const PROP_RESULT_MARK = Result::PROP_MARK;
    const PROP_RESULT_DATE = Result::PROP_DATE;
    const PROP_SUBJECT_NAME = Subject::PROP_NAME;
    const PROP_GROUP_NAME = Group::PROP_NAME;
    const PROP_EXAM_ID = Exam::PROP_ID;
    const PROP_EXAM_HEAD_ID = Exam::PROP_HEAD_ID;
    const PROP_EXAM_MEMBER1_ID = Exam::PROP_MEMBER1_ID;
    const PROP_EXAM_MEMBER2_ID = Exam::PROP_MEMBER2_ID;
    const PROP_DEPARTMENT_NAME = Department::PROP_NAME;
    const PROP_AY_START_YEAR = AcademicYear::PROP_YEAR;

    function __construct($params)
    {
        $ordinalNumber = intval($params[self::PROP_ORDINAL_NUMBER]);
        $mark = intval($params[self::PROP_RESULT_MARK]);
        if ($mark < 4 || $mark > 10) {
            $mark = 4;
        }
        $examID = intval($params[self::PROP_EXAM_ID]);
        $headID = intval($params[self::PROP_EXAM_HEAD_ID]);
        $m1ID = intval($params[self::PROP_EXAM_MEMBER1_ID]);
        $m2ID = intval($params[self::PROP_EXAM_MEMBER2_ID]);
        $academicYearStart = intval($params[self::PROP_AY_START_YEAR]);
        $academicYearEnd = $academicYearStart + 1;
        $aySpan = $academicYearStart . ' - ' . $academicYearEnd;

        $this->properties[self::PROP_ORDINAL_NUMBER] = new IntegerProperty(
            self::PROP_ORDINAL_NUMBER, '#', $ordinalNumber, true, true, 0
        );
        $this->properties[self::PROP_EXAM_ID] = new IntegerProperty(
            self::PROP_EXAM_ID, 'Provimi', $examID, true, false
        );
        $this->properties[self::PROP_RESULT_MARK] = new IntegerProperty(
            self::PROP_RESULT_MARK, 'Nota', $mark, true, true, 4, 10
        );
        $this->properties[self::PROP_EXAM_HEAD_ID] = new IntegerProperty(
            self::PROP_EXAM_HEAD_ID, 'Kryetari', $headID, true, false
        );
        $this->properties[self::PROP_EXAM_MEMBER1_ID] = new IntegerProperty(
            self::PROP_EXAM_MEMBER1_ID, 'Anetari 1', $m1ID, true, false
        );
        $this->properties[self::PROP_EXAM_MEMBER2_ID] = new IntegerProperty(
            self::PROP_EXAM_MEMBER2_ID, 'Anetari 2', $m2ID, true, false
        );
        $this->properties[self::PROP_STUDENT_FIRST_NAME] = new StringProperty(
            self::PROP_STUDENT_FIRST_NAME, 'Emri', $params[self::PROP_STUDENT_FIRST_NAME], false, true
        );
        $this->properties[self::PROP_STUDENT_LAST_NAME] = new StringProperty(
            self::PROP_STUDENT_LAST_NAME, 'Emri', $params[self::PROP_STUDENT_LAST_NAME], false, true
        );
        $this->properties[self::PROP_GROUP_NAME] = new StringProperty(
            self::PROP_GROUP_NAME, 'Grupi', $params[self::PROP_GROUP_NAME], false, false
        );
        $this->properties[self::PROP_SUBJECT_NAME] = new StringProperty(
            self::PROP_SUBJECT_NAME, 'L&eumlnda', $params[self::PROP_SUBJECT_NAME], false, true
        );
        $this->properties[self::PROP_AY_START_YEAR] = new StringProperty(
            self::PROP_AY_START_YEAR, 'Viti Akademik', $aySpan, false, true
        );
        $this->properties[self::PROP_RESULT_DATE] = new DateProperty(
            self::PROP_RESULT_DATE, 'Data', $params[self::PROP_RESULT_DATE], false, true
        );
    }


    /**
     * @return string
     */
    public function getEntityName()
    {
        return 'Flete Provimi';
    }

    /**
     * @return array
     */
    public function getIdentifier()
    {
        return array(
            Result::PROP_STUDENT_ID => $this->getProperty(self::PROP_STUDENT_ID)->getValue(),
            Result::PROP_EXAM_ID => $this->getProperty(self::PROP_EXAM_ID)->getValue()
        );
    }

    /**
     * @return EntityBuilderHelper
     */
    public static function getBuilder()
    {
        return new EntityBuilderHelper(__CLASS__, '', self::LABEL);
    }

    /**
     * @param int $seasonID
     * @param int $subjectID
     * @param int $groupID
     * @param int $professorID
     * @param bool $isImprovement
     * @return ExamResult[]
     */
    public static function getFilteredList($seasonID, $subjectID, $groupID, $professorID, $isImprovement)
    {
        $i = 1;
        $examResults = array();

        $examResultQuery = new ExamResultQuery($seasonID, $subjectID, $groupID, $professorID, $isImprovement);
        $resultList = $examResultQuery->exec();
        while (($params = $resultList->fetch_assoc()) !== NULL) {

            $params[self::PROP_ORDINAL_NUMBER] = $i;
            $examResult = new ExamResult($params);
            array_push($examResults, $examResult);

            $i++;
        }

        return $examResults;
    }

}