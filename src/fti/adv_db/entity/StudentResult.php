<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/27/2015
 * Time: 11:37 PM
 */

namespace fti\adv_db\entity;


use fti\adv_db\db\StudentResultQuery;
use fti\adv_db\entity\util\EntityBuilderHelper;
use fti\adv_db\property\BasicProperty;
use fti\adv_db\property\IntegerProperty;
use fti\adv_db\property\StringProperty;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class StudentResult
 * @package fti\adv_db\entity
 */
class StudentResult extends CompositeEntity
{

    const PROP_ORDINAL_NUMBER = 'ordinalNumber';
    const PROP_SUBJECT_NAME = Subject::PROP_NAME;
    const PROP_MARK = Result::PROP_MARK;

    /**
     * @param array $params
     */
    function __construct($params)
    {
        $ordinalNumber = intval($params[self::PROP_ORDINAL_NUMBER]);
        $mark = intval($params[self::PROP_MARK]);
        if ($mark < 4 || $mark > 10) {
            $mark = 4;
        }

        $this->properties[self::PROP_ORDINAL_NUMBER] = new IntegerProperty(
            self::PROP_ORDINAL_NUMBER, '#', $ordinalNumber, true, true, 0
        );
        $this->properties[self::PROP_SUBJECT_NAME] = new StringProperty(
            self::PROP_SUBJECT_NAME, 'L&eumlnda', $params[self::PROP_SUBJECT_NAME], false, true
        );
        $this->properties[self::PROP_MARK] = new IntegerProperty(
            self::PROP_MARK, 'Nota', $mark, true, true, 4, 10
        );
    }


    /**
     * @return string
     */
    public function getEntityName()
    {
        return 'Rezultatet';
    }

    /**
     * @param string $propertyName
     * @return BasicProperty
     */
    public function getProperty($propertyName)
    {
        return $this->properties[$propertyName];
    }

    /**
     * @return BasicProperty[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @return array
     */
    public function getIdentifier()
    {
        return array();
    }

    /**
     * @return EntityBuilderHelper
     */
    public static function getBuilder()
    {
        return new EntityBuilderHelper(__CLASS__, '', '');
    }

    /**
     * @param UserEntity $studentInstance
     * @return StudentResult[]
     */
    public static function getList($studentInstance)
    {
        $i = 0;
        $studentResults = array();
        $studentID = $studentInstance->getProperty(Student::PROP_ID)->getValue();

        $selectQuery = new StudentResultQuery($studentID);
        $resultList = $selectQuery->exec();
        while (($params = $resultList->fetch_assoc()) !== NULL) {

            $params[self::PROP_ORDINAL_NUMBER] = $i;

            $studentResult = new StudentResult($params);
            array_push($studentResults, $studentResult);

            $i++;
        }

        return $studentResults;
    }


}