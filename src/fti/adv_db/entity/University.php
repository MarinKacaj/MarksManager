<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/9/2015
 * Time: 9:52 PM
 */

namespace fti\adv_db\entity;


use fti\adv_db\entity\util\EmptyEntityBuilder;
use fti\adv_db\entity\util\EntityActionHelper;
use fti\adv_db\property\IntegerProperty;
use fti\adv_db\property\StringProperty;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class University
 * @package fti\adv_db\entity
 */
class University extends BasicEntity
{

    const TABLE_NAME = 'ial';
    const LABEL = 'IAL';
    const PROP_ID = 'ID';

    const PROP_NAME = 'em_ial';

    /**
     * @param array $params
     */
    function __construct($params)
    {
        $this->label = self::LABEL;
        $this->setIdFromParams(self::PROP_ID, $params);
        $this->properties[self::PROP_ID] = new IntegerProperty(self::PROP_ID, 'ID', $this->id, false);
        $this->properties[self::PROP_NAME] = new StringProperty(self::PROP_NAME, 'Emri', $params[self::PROP_NAME], true);

        $this->actionHelper = new EntityActionHelper(self::TABLE_NAME, $this);
    }


    /**
     * @return University
     */
    public static function createEmpty()
    {
        $emptyInstance = EmptyEntityBuilder::buildFromParamNames(__CLASS__);
        return $emptyInstance;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->properties[self::PROP_NAME]->getValue();
    }

    /**
     * @param int $uniqueIdentifier
     * @return University
     */
    public static function retrieve($uniqueIdentifier)
    {
        return EntityActionHelper::retrieve(
            __CLASS__,
            self::TABLE_NAME,
            array(self::getPrimaryKeyColName() => $uniqueIdentifier)
        );
    }

    /**
     * @return University[]
     */
    public static function getList()
    {
        return EntityActionHelper::getFullList(__CLASS__, self::TABLE_NAME);
    }


}