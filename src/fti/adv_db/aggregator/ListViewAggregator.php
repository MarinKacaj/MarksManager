<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/19/2015
 * Time: 12:15 AM
 */

namespace fti\adv_db\aggregator;


use fti\adv_db\entity\BasicEntity;
use fti\adv_db\property\BasicProperty;
use fti\adv_db\view\ListViewGenerator;

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
     * @var BasicEntity[]
     */
    private $entityInstances;

    /**
     * @param BasicEntity[] $entityInstances - must not be empty, should at least be an array of >=1 empty instances
     */
    function __construct($entityInstances)
    {
        $this->entityInstances = $entityInstances;

        $propertyNames = $this->extractEntityInstanceListPropertiesNames($entityInstances[0]);
        $this->listViewGenerator = new ListViewGenerator($propertyNames);
    }


    /**
     * @param BasicEntity $entityInstance
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
     * @param BasicEntity $entityInstance
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
     * @param BasicEntity $entityInstance
     * @return string[]
     */
    private function extractEntityInstanceListPropertiesValues($entityInstance)
    {
        $listPropertiesValues = array();

        $listProperties = $this->extractEntityInstanceListProperties($entityInstance);
        foreach ($listProperties as $listProperty) {
            array_push($listPropertiesValues, $listProperty->getValue());
        }
        unset($listProperty);

        return $listPropertiesValues;
    }

    /**
     * @return string
     */
    public function buildListHTML()
    {
        foreach ($this->entityInstances as $entityInstance) {
            $values = $this->extractEntityInstanceListPropertiesValues($entityInstance);
            $deleteURL = 'delete.php?' . http_build_str($entityInstance->getIdentifier());
            $updateURL = 'edit.php?' . http_build_str($entityInstance->getIdentifier());
            $this->listViewGenerator->appendRow($values, $deleteURL, $updateURL);
        }
        unset($entityInstance);

        return $this->listViewGenerator->getBuiltHTML();
    }


}