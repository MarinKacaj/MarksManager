<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/22/2015
 * Time: 11:28 PM
 */

namespace fti\adv_db\entity;


use fti\adv_db\entity\util\EntityActionHelper;
use fti\adv_db\entity\util\EntityBuilderHelper;
use fti\adv_db\property\EntityProperty;
use fti\adv_db\property\IntegerProperty;
use InvalidArgumentException;

require_once dirname(dirname(__FILE__)) . '/constants/gen_purpose.php';
require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class Exam
 * @package fti\adv_db\entity
 */
class Exam extends BasicEntity
{

    const TABLE_NAME = 'provim';
    const LABEL = 'Provim';

    const PROP_SEASON_ID = 'id_sezon';
    const PROP_SUBJECT_ID = 'id_lende';
    const PROP_DEPARTMENT_ID = 'id_dege';
    const PROP_HEAD_ID = 'id_kryetar_komisioni';
    const PROP_MEMBER1_ID = 'id_antar1';
    const PROP_MEMBER2_ID = 'id_antar2';

    private $headID;
    private $member1ID;
    private $member2ID;

    /**
     * @param array $params
     * @param bool $isPartOfList [optional]
     */
    function __construct($params, $isPartOfList = false)
    {
        if (!isset($params[self::PROP_ID])) {
            $params[self::PROP_ID] = BasicEntity::UNSAVED_INSTANCE_ID;
        }

        $headID = intval($params[self::PROP_HEAD_ID]);
        $member1ID = intval($params[self::PROP_MEMBER1_ID]);
        $member2ID = intval($params[self::PROP_MEMBER2_ID]);
        $seasonID = intval($params[self::PROP_SEASON_ID]);
        $subjectID = intval($params[self::PROP_SUBJECT_ID]);
        $departmentID = intval($params[self::PROP_DEPARTMENT_ID]);
        $seasonInstance = Season::getBuilder()->getByIdentifier(array(Season::PROP_ID => $seasonID));
        $subjectInstance = Subject::getBuilder()->getByIdentifier(array(Subject::PROP_ID => $subjectID));
        $departmentInstance = Department::getBuilder()->getByIdentifier(array(Department::PROP_ID => $departmentID));

        $this->headID = $headID;
        $this->member1ID = $member1ID;
        $this->member2ID = $member2ID;

        $this->label = self::LABEL;
        $this->id = array(self::PROP_ID => $params[self::PROP_ID]);
        $this->properties[self::PROP_ID] = new IntegerProperty(self::PROP_ID, 'ID', $this->id[self::PROP_ID], false, false);
        $this->properties[self::PROP_SEASON_ID] = new EntityProperty(
            self::PROP_SEASON_ID, 'Sezon', intval($params[self::PROP_SEASON_ID]), Season::getBuilder()->getList($isPartOfList), true,
            true, $seasonInstance
        );
        $this->properties[self::PROP_SUBJECT_ID] = new EntityProperty(
            self::PROP_SUBJECT_ID, 'Lende', $subjectID, Subject::getBuilder()->getList($isPartOfList), true,
            true, $subjectInstance
        );
        $this->properties[self::PROP_DEPARTMENT_ID] = new EntityProperty(
            self::PROP_DEPARTMENT_ID, 'Dege', $departmentID, Department::getBuilder()->getList($isPartOfList), true,
            true, $departmentInstance
        );
        $this->properties[self::PROP_HEAD_ID] = new EntityProperty(
            self::PROP_HEAD_ID, 'Kryetar Komisioni', $headID, Professor::getBuilder()->getList($isPartOfList), true
        );
        $this->properties[self::PROP_MEMBER1_ID] = new EntityProperty(
            self::PROP_MEMBER1_ID, 'An&euml;tar 1', $member1ID, Professor::getBuilder()->getList($isPartOfList), true
        );
        $this->properties[self::PROP_MEMBER2_ID] = new EntityProperty(
            self::PROP_MEMBER2_ID, 'An&euml;tar 2', $member2ID, Professor::getBuilder()->getList($isPartOfList), true
        );

        $this->actionHelper = new EntityActionHelper(self::TABLE_NAME, $this);
        $this->isPartOfList = $isPartOfList;
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
        return $this->getProperty(self::PROP_SUBJECT_ID)->getEntityInstance()->getDisplayName();
    }

    private function validateProfessors()
    {
        if (($this->headID === $this->member1ID || $this->headID === $this->member2ID || $this->member1ID === $this->member2ID)) {
            throw new InvalidArgumentException('Professors must not be the same', EXAM_ERROR_CONSTRAINT_VIOLATION);
        }
    }

    /**
     * @return Exam
     */
    public function save()
    {
        $this->validateProfessors();
        return parent::save();
    }

    /**
     * @return Exam
     */
    public function update()
    {
        $this->validateProfessors();
        return parent::update();
    }


}