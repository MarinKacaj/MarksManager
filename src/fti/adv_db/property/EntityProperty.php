<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/11/2015
 * Time: 12:12 PM
 */

namespace fti\adv_db\property;


use DOMElement;
use fti\adv_db\entity\BasicEntity;
use fti\adv_db\entity\Entity;
use fti\adv_db\view\DetailViewGenerator;
use fti\adv_db\view\FormViewGenerator;

require_once dirname(dirname(__FILE__)) . '/functions/auto_loader.php';

spl_autoload_register('class_auto_loader');

/**
 * Class EntityProperty
 * @package fti\adv_db\property
 */
class EntityProperty extends BasicProperty
{

    /**
     * @var int
     */
    protected $value;
    /**
     * @var BasicEntity
     */
    private $entityInstance;
    /**
     * @var BasicEntity[]
     */
    private $entityInstances;

    /**
     * @param string $name
     * @param string $label
     * @param int $value
     * @param BasicEntity[] $entityInstances - NOT EMPTY
     * @param bool $showOnForm
     * @param bool $showOnList [optional]
     * @param bool|BasicEntity $entityInstance [optional]
     */
    function __construct($name, $label, $value, $entityInstances, $showOnForm, $showOnList = false, $entityInstance = false)
    {
        parent::__construct($name, $name, BasicProperty::ENTITY, $label, $showOnForm, $showOnList);

        $this->value = $value;
        $this->entityInstances = $entityInstances;
        $this->entityInstance = $entityInstance;
    }


    /**
     * @return BasicEntity
     */
    public function getEntityInstance()
    {
        return $this->entityInstance;
    }

    /**
     * @return int|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param BasicEntity $value
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @param FormViewGenerator $formViewGenerator
     * @param string $name
     */
    public function buildFormBlock($formViewGenerator, $name)
    {
        $valueTextPairs = array();
        $entityInstances = $this->entityInstances;

        foreach ($entityInstances as $entityInstance) {
            $value = $entityInstance->getIdentifier();
            $text = $entityInstance->getDisplayName();
            /*
             * Every entity that will be referenced by another one should have a single primary key
             */
            $valueTextPairs[$value[Entity::PROP_ID]] = $text;
        }
        unset($entityInstance);

        $formViewGenerator->appendSelectBlock($this->label, $name, $valueTextPairs, $this->value);
    }

    /**
     * @param DetailViewGenerator $detailViewGenerator
     * @param string $name
     * @return DOMElement
     */
    public function buildDetailBlock($detailViewGenerator, $name)
    {
        // TODO: Implement createDetailBlock() method.
    }


}