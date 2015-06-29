<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/29/2015
 * Time: 1:49 AM
 */

namespace fti\adv_db\entity;


use fti\adv_db\entity\util\EntityBuilderHelper;
use fti\adv_db\property\IntegerProperty;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class ExamResult
 * @package fti\adv_db\entity
 */
class ExamResult extends CompositeEntity
{

    const PROP_STUDENT_ID = Student::PROP_ID;
    const PROP_STUDENT_FIRST_NAME = Student::PROP_FIRST_NAME;
    const PROP_STUDENT_LAST_NAME = Student::PROP_LAST_NAME;
    const PROP_RESULT_MARK = Result::PROP_MARK;
    const PROP_RESULT_DATE = Result::PROP_DATE;
    const PROP_SUBJECT_NAME = Subject::PROP_NAME;
    const PROP_GROUP_NAME = Group::PROP_NAME;
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

        $this->properties[self::PROP_ORDINAL_NUMBER] = new IntegerProperty(
            self::PROP_ORDINAL_NUMBER, '#', $ordinalNumber, true, true, 0
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
     * @return EntityBuilderHelper
     */
    public static function getBuilder()
    {
        return new EntityBuilderHelper(__CLASS__, '', '');
    }

}