<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/22/2015
 * Time: 10:50 PM
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
 * Class Department
 * @package fti\adv_db\entity
 */
class Department extends BasicEntity
{

    const TABLE_NAME = 'dege';
    const LABEL = 'Deg&euml;';

    const PROP_NAME = 'em_dege';
    const PROP_FACULTY_ID = 'id_njk';

    /**
     * @param array $params
     */
    function __construct($params)
    {
        $this->label = self::LABEL;
        $this->id = array(self::PROP_ID => $params[self::PROP_ID]);
        $this->properties[self::PROP_ID] = new IntegerProperty(self::PROP_ID, 'ID', $this->id[self::PROP_ID], false, false);
        $this->properties[self::PROP_NAME] = new StringProperty(self::PROP_NAME, 'Emri', $params[self::PROP_NAME], true, true);
        $this->properties[self::PROP_FACULTY_ID] = new EntityProperty(
            self::PROP_FACULTY_ID, 'Fakulteti', intval($params[self::PROP_FACULTY_ID]), Faculty::getBuilder()->getList(), true
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