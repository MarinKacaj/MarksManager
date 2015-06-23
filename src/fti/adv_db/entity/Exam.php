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

    /**
     * @param array $params
     */
    function __construct($params)
    {
        $this->label = self::LABEL;
        $this->id = array(self::PROP_ID => $params[self::PROP_ID]);
        $this->properties[self::PROP_ID] = new IntegerProperty(self::PROP_ID, 'ID', $this->id[self::PROP_ID], false, false);

        $this->properties[self::PROP_SEASON_ID] = new EntityProperty(
            self::PROP_SEASON_ID, 'Sezoni', intval($params[self::PROP_SEASON_ID]), Season::getBuilder()->getList(), true
        );
        $this->properties[self::PROP_SUBJECT_ID] = new EntityProperty(
            self::PROP_SUBJECT_ID, 'Lende', intval($params[self::PROP_SUBJECT_ID]), Subject::getBuilder()->getList(), true
        );
        $this->properties[self::PROP_DEPARTMENT_ID] = new EntityProperty(
            self::PROP_DEPARTMENT_ID, 'Dege', intval($params[self::PROP_DEPARTMENT_ID]), Department::getBuilder()->getList(), true
        );
        $this->properties[self::PROP_HEAD_ID] = new EntityProperty(
            self::PROP_HEAD_ID, 'Kryetar Komisioni', intval($params[self::PROP_HEAD_ID]), Professor::getBuilder()->getList(), true
        );
        $this->properties[self::PROP_MEMBER1_ID] = new EntityProperty(
            self::PROP_MEMBER1_ID, 'Anetar 1', intval($params[self::PROP_MEMBER1_ID]), Professor::getBuilder()->getList(), true
        );
        $this->properties[self::PROP_MEMBER2_ID] = new EntityProperty(
            self::PROP_MEMBER2_ID, 'Anetar 2', intval($params[self::PROP_MEMBER2_ID]), Professor::getBuilder()->getList(), true
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
        return $this->getProperty(self::PROP_SUBJECT_ID)->getValue();
    }
}