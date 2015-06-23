<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/22/2015
 * Time: 10:53 PM
 */

namespace fti\adv_db\entity;


use fti\adv_db\entity\util\EntityActionHelper;
use fti\adv_db\entity\util\EntityBuilderHelper;
use fti\adv_db\property\IntegerProperty;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class AcademicYear
 * @package fti\adv_db\entity
 */
class AcademicYear extends BasicEntity
{

    const TABLE_NAME = 'va';
    const LABEL = 'Viti Akademik';

    const PROP_YEAR = 'viti';

    /**
     * @param array $params
     */
    function __construct($params)
    {
        $this->label = self::LABEL;
        $this->id = array(self::PROP_ID => $params[self::PROP_ID]);
        $this->properties[self::PROP_ID] = new IntegerProperty(self::PROP_ID, 'ID', $this->id[self::PROP_ID], false, false);
        $this->properties[self::PROP_YEAR] = new IntegerProperty(self::PROP_YEAR, 'Viti', intval($params[self::PROP_YEAR]), true, true);

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
        return $this->getProperty(self::PROP_YEAR)->getValue();
    }
}