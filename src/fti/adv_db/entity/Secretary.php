<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/22/2015
 * Time: 11:22 PM
 */

namespace fti\adv_db\entity;


use fti\adv_db\entity\util\EntityActionHelper;
use fti\adv_db\entity\util\EntityBuilderHelper;
use fti\adv_db\property\IntegerProperty;
use fti\adv_db\property\StringProperty;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class Secretary
 * @package fti\adv_db\entity
 */
class Secretary extends BasicEntity
{

    const TABLE_NAME = 'sekretare';
    const LABEL = 'Sekretare';

    const PROP_FIRST_NAME = 'em_sektretare';
    const PROP_LAST_NAME = 'mb_sekretare';
    const PROP_SC_DEGREE = 'titull';
    const PROP_EMAIL = 'email';
    const PROP_PASSWORD = 'password';

    /**
     * @param array $params
     */
    function __construct($params)
    {
        $this->label = self::LABEL;
        $this->id = array(self::PROP_ID => $params[self::PROP_ID]);
        $this->properties[self::PROP_ID] = new IntegerProperty(self::PROP_ID, 'ID', $this->id[self::PROP_ID], false, false);
        $this->properties[self::PROP_FIRST_NAME] = new StringProperty(
            self::PROP_FIRST_NAME, 'Emri', $params[self::PROP_FIRST_NAME], true, true
        );
        $this->properties[self::PROP_LAST_NAME] = new StringProperty(
            self::PROP_LAST_NAME, 'Mbiemri', $params[self::PROP_LAST_NAME], true, true
        );
        $this->properties[self::PROP_SC_DEGREE] = new StringProperty(
            self::PROP_SC_DEGREE, 'Titulli', $params[self::PROP_SC_DEGREE], true, true
        );
        $this->properties[self::PROP_EMAIL] = new StringProperty(
            self::PROP_EMAIL, 'Email', $params[self::PROP_EMAIL], true, true
        );
        $this->properties[self::PROP_PASSWORD] = new StringProperty(
            self::PROP_PASSWORD, 'Password', $params[self::PROP_PASSWORD], true, true
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
        return $this->getProperty(self::PROP_FIRST_NAME)->getValue() . ' ' .
        $this->getProperty(self::PROP_LAST_NAME)->getValue();
    }
}