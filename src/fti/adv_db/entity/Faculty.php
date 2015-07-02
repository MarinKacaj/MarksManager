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
use InvalidArgumentException;

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

    private $headSecretaryID;
    private $secretaryID;

    /**
     * @param array $params
     * @param bool $isPartOfList [optional]
     */
    function __construct($params, $isPartOfList = false)
    {
        $this->label = 'NJK';

        $headSecretaryID = intval($params[self::PROP_HEAD_SECRETARY_ID]);
        $secretaryID = intval($params[self::PROP_SECRETARY_ID]);

        $this->headSecretaryID = $headSecretaryID;
        $this->secretaryID = $secretaryID;

        $this->properties = array();
        $this->id = array(self::PROP_ID => $params[self::PROP_ID]);
        $this->properties[self::PROP_ID] = new IntegerProperty(self::PROP_ID, 'ID', $this->id[self::PROP_ID], false, false);
        $this->properties[self::PROP_NAME] = new StringProperty(self::PROP_NAME, 'Emri', $params[self::PROP_NAME], true, true);
        $this->properties[self::PROP_ADDRESS] = new StringProperty(self::PROP_ADDRESS, 'Adresa', $params[self::PROP_ADDRESS], true, true);
        $this->properties[self::PROP_DEAN_ID] = new EntityProperty(self::PROP_DEAN_ID, 'Dekani',
            intval($params[self::PROP_DEAN_ID]), Professor::getBuilder()->getList($isPartOfList), true
        );
        $this->properties[self::PROP_HEAD_SECRETARY_ID] = new EntityProperty(
            self::PROP_HEAD_SECRETARY_ID, 'Krye Sekretarja',
            $headSecretaryID, Secretary::getBuilder()->getList($isPartOfList), true
        );
        $this->properties[self::PROP_SECRETARY_ID] = new EntityProperty(
            self::PROP_SECRETARY_ID, 'Sekretarja',
            $secretaryID, Secretary::getBuilder()->getList($isPartOfList), true
        );
        $this->properties[self::PROP_UNIVERSITY_ID] = new EntityProperty(
            self::PROP_UNIVERSITY_ID, 'Universiteti', $params[self::PROP_UNIVERSITY_ID],
            University::getBuilder()->getList($isPartOfList), true
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
        return $this->getProperty(self::PROP_NAME)->getValue();
    }

    private function validateSecretaries()
    {
        if ($this->headSecretaryID === $this->secretaryID) {
            throw new InvalidArgumentException('Secretaries must not be the same', FACULTY_ERROR_CONSTRAINT_VIOLATION);
        }
    }

    /**
     * @return Exam
     */
    public function save()
    {
        $this->validateSecretaries();
        return parent::save();
    }

    /**
     * @return Exam
     */
    public function update()
    {
        $this->validateSecretaries();
        return parent::update();
    }


}