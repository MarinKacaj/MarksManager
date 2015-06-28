<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/22/2015
 * Time: 11:00 PM
 */

namespace fti\adv_db\entity;


use fti\adv_db\entity\util\EntityActionHelper;
use fti\adv_db\entity\util\EntityBuilderHelper;
use fti\adv_db\property\StringProperty;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class Professor
 * @package fti\adv_db\entity
 */
class Professor extends UserEntity
{

    const TABLE_NAME = 'pedagog';
    const LABEL = 'Pedagog';

    const PROP_FIRST_NAME = 'em_pedagog';
    const PROP_LAST_NAME = 'mb_pedagog';
    const PROP_SC_DEGREE = 'titull';

    /**
     * @param array $params
     */
    function __construct($params)
    {
        parent::__construct($params);

        $this->label = self::LABEL;
        $this->properties[self::PROP_FIRST_NAME] = new StringProperty(self::PROP_FIRST_NAME, 'Emri', $params[self::PROP_FIRST_NAME], true, true);
        $this->properties[self::PROP_LAST_NAME] = new StringProperty(self::PROP_LAST_NAME, 'Mbiemri', $params[self::PROP_LAST_NAME], true, true);
        $this->properties[self::PROP_SC_DEGREE] = new StringProperty(self::PROP_SC_DEGREE, 'Titull', $params[self::PROP_SC_DEGREE], true, true);

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
        return $this->getProperty(self::PROP_FIRST_NAME)->getValue() . ' ' . $this->getProperty(self::PROP_LAST_NAME)->getValue();
    }
}