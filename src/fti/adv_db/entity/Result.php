<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/22/2015
 * Time: 11:38 PM
 */

namespace fti\adv_db\entity;


use fti\adv_db\entity\util\EntityActionHelper;
use fti\adv_db\entity\util\EntityBuilderHelper;
use fti\adv_db\property\DateProperty;
use fti\adv_db\property\EntityProperty;
use fti\adv_db\property\IntegerProperty;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class Result
 * @package fti\adv_db\entity
 */
class Result extends BasicEntity
{

    const TABLE_NAME = 'rezultat';
    const LABEL = 'Rezultat';

    const PROP_EXAM_ID = 'id_provim';
    const PROP_STUDENT_ID = 'id_student';
    const PROP_MARK = 'note';
    const PROP_DATE = 'date_provim';

    /**
     * @param array $params
     */
    function __construct($params)
    {
        $this->label = self::LABEL;
        $this->id = array(
            self::PROP_EXAM_ID => intval($params[self::PROP_EXAM_ID]),
            self::PROP_STUDENT_ID => intval($params[self::PROP_STUDENT_ID])
        );

        $mark = intval($params[self::PROP_MARK]);
        if ($mark < 4 || $mark > 10) {
            $mark = 4;
        }

        $this->properties[self::PROP_EXAM_ID] = new EntityProperty(
            self::PROP_EXAM_ID, 'Provimi', $params[self::PROP_EXAM_ID], Exam::getBuilder()->getList(), true
        );
        $this->properties[self::PROP_STUDENT_ID] = new EntityProperty(
            self::PROP_STUDENT_ID, 'Studenti', $params[self::PROP_STUDENT_ID], Student::getBuilder()->getList(), true
        );
        $this->properties[self::PROP_MARK] = new IntegerProperty(
            self::PROP_MARK, 'Nota', $mark, true, true, 4, 10
        );
        $this->properties[self::PROP_DATE] = new DateProperty(
            self::PROP_DATE, 'Data e Provimit', intval($params[self::PROP_DATE]), true, true
        );

        $this->actionHelper = new EntityActionHelper(self::TABLE_NAME, $this);
    }


    /**
     * @return EntityBuilderHelper
     */
    public static function getBuilder()
    {
        return new EntityBuilderHelper(__CLASS__, self::TABLE_NAME, self::LABEL);
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getProperty(self::PROP_MARK)->getValue();
    }
}