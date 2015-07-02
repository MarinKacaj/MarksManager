<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/19/2015
 * Time: 12:15 AM
 */

namespace fti\adv_db\aggregator;


use fti\adv_db\entity\Entity;
use fti\adv_db\property\BasicProperty;
use fti\adv_db\property\BooleanProperty;
use fti\adv_db\property\EntityProperty;
use fti\adv_db\view\ListViewGenerator;

require_once dirname(dirname(__FILE__)) . '/constants/gen_purpose.php';
require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';
require_once dirname(dirname(__FILE__)) . '/functions/http_utils.php';

spl_autoload_register('class_auto_loader');

/**
 * Class ListViewAggregator
 * @package fti\adv_db\aggregator
 */
class ListViewAggregator
{

    /**
     * @var ListViewGenerator
     */
    private $listViewGenerator;
    /**
     * @var Entity[]
     */
    private $entityInstances;
    /**
     * @var bool
     */
    private $tableHasActions;

    /**
     * @param Entity[] $entityInstances - must not be empty, should at least be an array of >=1 empty instances
     * @param bool $tableHasActions [optional]
     */
    function __construct($entityInstances, $tableHasActions = true)
    {
        $this->entityInstances = $entityInstances;

        $propertyNames = $this->extractEntityInstanceListPropertiesNames($entityInstances[0]);
        $this->tableHasActions = $tableHasActions;
        $this->listViewGenerator = new ListViewGenerator($propertyNames, $tableHasActions);
    }


    /**
     * @param boolean $isUpdateButtonDisplayed
     */
    public function setIsUpdateButtonDisplayed($isUpdateButtonDisplayed)
    {
        $this->listViewGenerator->setIsUpdateButtonDisplayed($isUpdateButtonDisplayed);
    }

    /**
     * @param boolean $isDeleteButtonDisplayed
     */
    public function setIsDeleteButtonDisplayed($isDeleteButtonDisplayed)
    {
        $this->listViewGenerator->setIsDeleteButtonDisplayed($isDeleteButtonDisplayed);
    }

    /**
     * @param Entity $entityInstance
     * @return BasicProperty[]
     */
    private function extractEntityInstanceListProperties($entityInstance)
    {
        $listProperties = array();

        $properties = $entityInstance->getProperties();
        foreach ($properties as $property) {
            if ($property->isShowOnList()) {
                array_push($listProperties, $property);
            }
        }
        unset($property);

        return $listProperties;
    }

    /**
     * @param Entity $entityInstance
     * @return string[]
     */
    private function extractEntityInstanceListPropertiesNames($entityInstance)
    {
        $listPropertiesNames = array();

        $listProperties = $this->extractEntityInstanceListProperties($entityInstance);
        foreach ($listProperties as $listProperty) {
            array_push($listPropertiesNames, $listProperty->getLabel());
        }
        unset($listProperty);

        return $listPropertiesNames;
    }

    /**
     * @param Entity $entityInstance
     * @return string[]
     */
    private function extractEntityInstanceListPropertiesValues($entityInstance)
    {
        $listPropertiesValues = array();

        $listProperties = $this->extractEntityInstanceListProperties($entityInstance);
        foreach ($listProperties as $listProperty) {
            if ($listProperty instanceof EntityProperty) {
                $value = $listProperty->getEntityInstance()->getDisplayName();
            } else if ($listProperty instanceof BooleanProperty) {
                $value = $listProperty->getDisplayValue();
            } else {
                $value = $listProperty->getValue();
            }
            array_push($listPropertiesValues, $value);
        }
        unset($listProperty);

        return $listPropertiesValues;
    }

    /**
     * @param bool $isEmpty [optional]
     * @param bool $appendCreateButton [optional]
     * @return string
     */
    public function buildListHTML($isEmpty = false, $appendCreateButton = true)
    {
        if (!$isEmpty) {
            foreach ($this->entityInstances as $entityInstance) {
                $values = $this->extractEntityInstanceListPropertiesValues($entityInstance);
                $deleteURL = DELETE_DEFAULT_FILE_NAME . '?' . http_build_str($entityInstance->getIdentifier());
                $updateURL = EDIT_DEFAULT_FILE_NAME . '?' . http_build_str($entityInstance->getIdentifier());
                $this->listViewGenerator->appendRow($values, $deleteURL, $updateURL);
            }
            unset($entityInstance);
        }

        return $this->listViewGenerator->getBuiltHTML($appendCreateButton);
    }


}