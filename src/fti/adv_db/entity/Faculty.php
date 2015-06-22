<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/13/2015
 * Time: 8:37 PM
 */

namespace fti\adv_db\entity;


use fti\adv_db\entity\util\EntityActionHelper;
use fti\adv_db\entity\util\EntityBuilderHelper;
use fti\adv_db\property\EntityProperty;
use fti\adv_db\property\IntegerProperty;
use fti\adv_db\property\StringProperty;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class Faculty
 * @package fti\adv_db\entity
 */
class Faculty extends BasicEntity
{

    const TABLE_NAME = 'njk';
    const LABEL = 'NJK';

    const PROP_NAME = 'em_njk';
    const PROP_ADDRESS = 'adrese';
    const PROP_DEAN_ID = 'dekan';
    const PROP_HEAD_SECRETARY_ID = 'kryesekretar';
    const PROP_SECRETARY_ID = 'sekretar';
    const PROP_UNIVERSITY_ID = 'id_ial';

    /**
     * @param array $params
     */
    function __construct($params)
    {
        $this->entityName = __CLASS__;
        $this->tableName = self::TABLE_NAME;
        $this->label = self::LABEL;

        $this->properties = array();
        $this->setIdFromParams(self::PROP_ID, $params);
        $this->properties[self::PROP_ID] = new IntegerProperty(self::PROP_ID, 'ID', $this->id[self::PROP_ID], false, false);
        $this->properties[self::PROP_NAME] = new StringProperty(self::PROP_NAME, 'Emri', $params[self::PROP_NAME], true, true);
        $this->properties[self::PROP_ADDRESS] = new StringProperty(self::PROP_ADDRESS, 'Adresa', $params[self::PROP_ADDRESS], true, true);
        $this->properties[self::PROP_DEAN_ID] = new IntegerProperty(self::PROP_DEAN_ID, 'Dekani', $params[self::PROP_DEAN_ID], true, false);
        $this->properties[self::PROP_HEAD_SECRETARY_ID] = new IntegerProperty(
            self::PROP_HEAD_SECRETARY_ID, 'Krye Sekretarja', $params[self::PROP_HEAD_SECRETARY_ID], true, false
        );
        $this->properties[self::PROP_SECRETARY_ID] = new IntegerProperty(
            self::PROP_SECRETARY_ID, 'Sekretarja', $params[self::PROP_SECRETARY_ID], true, false
        );
        $this->properties[self::PROP_UNIVERSITY_ID] = new EntityProperty(
            self::PROP_UNIVERSITY_ID, 'Universiteti', $params[self::PROP_UNIVERSITY_ID], University::getBuilder()->getList(), true
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
        return $this->getProperty(self::PROP_NAME)->getValue();
    }


}